<?php
    namespace frontend\modules\statistics\widgets;

    use frontend\modules\task\models\db\Order;
    use yii\base\Widget;

    class Statistics extends Widget
    {
        public function run()
        {
            $cacheTime = \Yii::$app->params['statsCacheTime'];

            $done = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])->count();
            }, $cacheTime);

            $like = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                    ->where(['kind' => 1])
                    ->sum('members_count');
            }, $cacheTime);

            $repost = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['kind' => 4])
                    ->sum('members_count');
            }, $cacheTime);

            return $this->render('stat', [
                'done'   => $done,
                'like'   => $like,
                'repost' => $repost,
            ]);
        }
    }