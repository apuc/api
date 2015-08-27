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
            $wrap = Wrap::getStat();

            $done = Order::find(['status' => [Order::DONE, Order::DONE_AND_HIDE]])
                ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                ->count();
            $like = self::getCount(1);
            $subscriber = self::getCount(3);
            $repost = self::getCount(4);

            $done += $wrap->done_wrap_vk;
            $like += $wrap->like_wrap_vk;
            $repost += $wrap->repost_wrap_vk;
            $subscriber += $wrap->subscriber_wrap_vk;

            return $this->render('menu', [
                'done'       => isset($done) ? $done : 0,
                'like'       => isset($like) ? $like : 0,
                'repost'     => isset($repost) ? $repost : 0,
                'subscriber' => isset($subscriber) ? $subscriber : 0,
            ]);
        }

        public static function getCount($kind)
        {
            $result = Order::find(['status' => [Order::DONE, Order::DONE_AND_HIDE]])
                ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                ->andWhere(['kind' => $kind])
                ->sum('members_count');

            return $result;
        }
    }