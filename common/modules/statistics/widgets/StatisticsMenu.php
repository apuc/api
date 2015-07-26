<?php
    namespace common\modules\statistics\widgets;

    use common\modules\statistics\models\Order;
    use yii\base\Widget;

    class StatisticsMenu extends Widget
    {
        public function run()
        {

            $cacheTime = \Yii::$app->params['statsWidgetCacheTime'];

            $done = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])->count();
            }, $cacheTime);

            $like = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                    ->andWhere(['kind' => 1])
                    ->sum('members_count');
            }, $cacheTime);

            $repost = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                    ->andWhere(['kind' => 4])
                    ->sum('members_count');
            }, $cacheTime);
            $subscriber = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                    ->andWhere(['kind' => 3])
                    ->sum('members_count');
            }, $cacheTime);

            return $this->render('menu', [
                'done'   => isset($done) ? $done : 0,
                'like'   => isset($like) ? $like : 0,
                'repost' => isset($repost) ? $repost : 0,
                'subscriber' => isset($subscriber) ? $subscriber : 0,
            ]);
        }
    }