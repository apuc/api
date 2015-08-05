<?php
    namespace common\modules\statistics\widgets;

    use common\models\db\Wrap;
    use common\modules\statistics\models\Order;
    use yii\base\Widget;

    class StatisticsMenu extends Widget
    {
        private $cacheTime = 0;

        public function init()
        {
            parent::init();

            $this->cacheTime = \Yii::$app->params['statsWidgetCacheTime'];
        }

        /**
         * @var Wrap $wrap
         * @return string
         * @throws \Exception
         */
        public function run()
        {
            $wrap = '';

            if (\Yii::$app->cache->exists('wrap')) {
                $wrap = unserialize(\Yii::$app->cache->get('wrap'));
            } else {
                $wrap = Wrap::findOne(1);

                $wrap->done_wrap_vk += rand(1, 4);
                $wrap->like_wrap_vk += rand(7, 15);
                $wrap->repost_wrap_vk += rand(5, 15);
                $wrap->subscriber_wrap_vk += rand(5, 15);

                $wrap->save();

                \Yii::$app->cache->set('wrap', serialize($wrap), rand(20, 40));
            }

            $done = Order::find(['status' => Order::DONE])->count();

            $like = $this->getCount('like', 1);
            $subscriber = $this->getCount('subscriber', 3);
            $repost = $this->getCount('repost', 4);

            $like+=$wrap->like_wrap_vk ;
            $subscriber+=$wrap->repost_wrap_vk;
            $repost+=$wrap->subscriber_wrap_vk;

            return $this->render('menu', [
                'done'       => isset($done) ? $done : 0,
                'like'       => isset($like) ? $like : 0,
                'repost'     => isset($repost) ? $repost : 0,
                'subscriber' => isset($subscriber) ? $subscriber : 0,
            ]);
        }

        private function getCount($type, $kind)
        {
                $result = Order::find(['status' => Order::DONE])
                        ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                        ->andWhere(['kind' => $kind])
                        ->sum('members_count');

            return $result;
        }
    }