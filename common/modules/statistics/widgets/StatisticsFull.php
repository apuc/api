<?php

    namespace common\modules\statistics\widgets;

    use common\modules\statistics\models\Order;
    use yii\base\Widget;

    class StatisticsFull extends Widget
    {
        public function run()
        {
            $statsForOneDay = $this->getStatistics1();
            $statsForSevenDays = $this->getStatistics7();
            $statsForOneMonth = $this->getStatistics30();
            $statsForAllTime = $this->getStatisticsAll();

            return $this->render('full', [
                'statsForOneDay'    => $statsForOneDay,
                'statsForSevenDays' => $statsForSevenDays,
                'statsForOneMonth'  => $statsForOneMonth,
                'statsForAllTime'   => $statsForAllTime,
            ]);
        }

        private function getStatistics1()
        {
            $cacheTime = \Yii::$app->params['statsWidgetCacheTime'];

            $done1 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                    ->count();
            }, $cacheTime);

            $like1 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                    ->andWhere(['kind' => 1])
                    ->sum('members_count');
            }, $cacheTime);

            $subscriber1 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                    ->andWhere(['kind' => 3])
                    ->sum('members_count');
            }, $cacheTime);

            $repost1 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                    ->andWhere(['kind' => 4])
                    ->sum('members_count');
            }, $cacheTime);

            $friend1 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                    ->andWhere(['kind' => 2])
                    ->sum('members_count');
            }, $cacheTime);

            $comment1 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                    ->andWhere(['kind' => 5])
                    ->sum('members_count');
            }, $cacheTime);

            $interview1 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                    ->andWhere(['kind' => 6])
                    ->sum('members_count');
            }, $cacheTime);

            $sum1 = Order::getDb()->cache(function () {
                return Order::find()
                    ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                    ->sum('sum');
            }, $cacheTime);

            return [
                'done1'       => isset($done1) ? $done1 : 0,
                'like1'       => isset($like1) ? $like1 : 0,
                'repost1'     => isset($repost1) ? $repost1 : 0,
                'subscriber1' => isset($subscriber1) ? $subscriber1 : 0,
                'friend1'     => isset($friend1) ? $friend1 : 0,
                'comment1'    => isset($comment1) ? $comment1 : 0,
                'interview1'  => isset($interview1) ? $interview1 : 0,
                'sum1'        => isset($sum1) ? $sum1 : 0,
            ];
        }

        private function getStatistics7()
        {
            //Обновляется раз в сутки
            $cacheTime = 60 * 60 * 24;

            $done7 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-7 day', time()))])
                    ->count();
            }, $cacheTime);

            $like7 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-7 day', time()))])
                    ->andWhere(['kind' => 1])
                    ->sum('members_count');
            }, $cacheTime);

            $subscriber7 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-7 day', time()))])
                    ->andWhere(['kind' => 3])
                    ->sum('members_count');
            }, $cacheTime);

            $repost7 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-7 day', time()))])
                    ->andWhere(['kind' => 4])
                    ->sum('members_count');
            }, $cacheTime);

            $friend7 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-7 day', time()))])
                    ->andWhere(['kind' => 2])
                    ->sum('members_count');
            }, $cacheTime);

            $comment7 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-7 day', time()))])
                    ->andWhere(['kind' => 5])
                    ->sum('members_count');
            }, $cacheTime);

            $interview7 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-7 day', time()))])
                    ->andWhere(['kind' => 6])
                    ->sum('members_count');
            }, $cacheTime);

            $sum7 = Order::getDb()->cache(function () {
                return Order::find()
                    ->where(['>', 'date', mktime(strftime('-7 day', time()))])
                    ->sum('sum');
            }, $cacheTime);

            return [
                'done7'       => isset($done7) ? $done7 : 0,
                'like7'       => isset($like7) ? $like7 : 0,
                'repost7'     => isset($repost7) ? $repost7 : 0,
                'subscriber7' => isset($subscriber7) ? $subscriber7 : 0,
                'friend7'     => isset($friend7) ? $friend7 : 0,
                'comment7'    => isset($comment7) ? $comment7 : 0,
                'interview7'  => isset($interview7) ? $interview7 : 0,
                'sum7'  => isset($sum7) ? $sum7 : 0,
            ];
        }

        private function getStatistics30()
        {
            //Обновляется раз в сутки
            $cacheTime = 60 * 60 * 24;

            $done30 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-30 day', time()))])
                    ->count();
            }, $cacheTime);

            $like30 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-30 day', time()))])
                    ->andWhere(['kind' => 1])
                    ->sum('members_count');
            }, $cacheTime);

            $subscriber30 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-30 day', time()))])
                    ->andWhere(['kind' => 3])
                    ->sum('members_count');
            }, $cacheTime);

            $repost30 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-30 day', time()))])
                    ->andWhere(['kind' => 4])
                    ->sum('members_count');
            }, $cacheTime);

            $friend30 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-30 day', time()))])
                    ->andWhere(['kind' => 2])
                    ->sum('members_count');
            }, $cacheTime);

            $comment30 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-30 day', time()))])
                    ->andWhere(['kind' => 5])
                    ->sum('members_count');
            }, $cacheTime);

            $interview30 = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime('-30 day', time()))])
                    ->andWhere(['kind' => 6])
                    ->sum('members_count');
            }, $cacheTime);

            $sum30 = Order::getDb()->cache(function () {
                return Order::find()
                    ->where(['>', 'date', mktime(strftime('-30 day', time()))])
                    ->sum('sum');
            }, $cacheTime);

            return [
                'done30'       => isset($done30) ? $done30 : 0,
                'like30'       => isset($like30) ? $like30 : 0,
                'repost30'     => isset($repost30) ? $repost30 : 0,
                'subscriber30' => isset($subscriber30) ? $subscriber30 : 0,
                'friend30'     => isset($friend30) ? $friend30 : 0,
                'comment30'    => isset($comment30) ? $comment30 : 0,
                'interview30'  => isset($interview30) ? $interview30 : 0,
                'sum30'  => isset($sum30) ? $sum30 : 0,
            ];
        }

        private function getStatisticsAll()
        {
            //Обновляется раз в сутки
            $cacheTime = 60 * 60 * 24;

            $doneAll = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->count();
            }, $cacheTime);

            $likeAll = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['kind' => 1])
                    ->sum('members_count');
            }, $cacheTime);

            $subscriberAll = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['kind' => 3])
                    ->sum('members_count');
            }, $cacheTime);

            $repostAll = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['kind' => 4])
                    ->sum('members_count');
            }, $cacheTime);

            $friendAll = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['kind' => 2])
                    ->sum('members_count');
            }, $cacheTime);

            $commentAll = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['kind' => 5])
                    ->sum('members_count');
            }, $cacheTime);

            $interviewAll = Order::getDb()->cache(function () {
                return Order::find(['status' => Order::DONE])
                    ->where(['kind' => 6])
                    ->sum('members_count');
            }, $cacheTime);

            $sumAll = Order::getDb()->cache(function () {
                return Order::find()
                    ->sum('sum');
            }, $cacheTime);

            return [
                'doneAll'       => isset($doneAll) ? $doneAll : 0,
                'likeAll'       => isset($likeAll) ? $likeAll : 0,
                'repostAll'     => isset($repostAll) ? $repostAll : 0,
                'subscriberAll' => isset($subscriberAll) ? $subscriberAll : 0,
                'friendAll'     => isset($friendAll) ? $friendAll : 0,
                'commentAll'    => isset($commentAll) ? $commentAll : 0,
                'interviewAll'  => isset($interviewAll) ? $interviewAll : 0,
                'sumAll'  => isset($sumAll) ? $sumAll : 0,
            ];
        }
    }