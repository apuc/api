<?php
    namespace common\modules\statistics\widgets;

    use common\modules\statistics\models\Order;
    use yii\base\Widget;

    class StatisticsMenu extends Widget
    {
        private $cacheTime = 0;

        public function init(){
            parent::init();

            $this->cacheTime = \Yii::$app->params['statsWidgetCacheTime'];
        }

        public function run()
        {
            $done = '';
            if (\Yii::$app->cache->exists('done'))
                $done = \Yii::$app->cache->get('done');
            else {
                $done = Order::getDb()->cache(function () {
                    return Order::find(['status' => Order::DONE])->count();
                }, $this->cacheTime);

                \Yii::$app->cache->set('done', $done);
            }

            $like = $this->getCount('like',1);
            $subscriber = $this->getCount('subscriber',3);
            $repost = $this->getCount('repost',4);

            return $this->render('menu', [
                'done'       => isset($done) ? $done : 0,
                'like'       => isset($like) ? $like : 0,
                'repost'     => isset($repost) ? $repost : 0,
                'subscriber' => isset($subscriber) ? $subscriber : 0,
            ]);
        }

        private function getCount($type, $kind)
        {
            $result = '';

            if (\Yii::$app->cache->exists($type))
                $result = \Yii::$app->cache->get($type);
            else {
                $result = Order::getDb()->cache(function () use($kind){
                    return Order::find(['status' => Order::DONE])
                        ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                        ->andWhere(['kind' => $kind])
                        ->sum('members_count');
                }, $this->cacheTime * 2);

                \Yii::$app->cache->set($type, $result, $this->cacheTime);
            }

            return $result;
        }
    }