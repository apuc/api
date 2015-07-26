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

            $done1 = '';
            if (\Yii::$app->cache->exists('done1'))
                $done1 = \Yii::$app->cache->get('done1');
            else {
                $done1 = Order::getDb()->cache(function () {
                    return Order::find(['status' => Order::DONE])
                        ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                        ->count();
                }, $cacheTime);

                \Yii::$app->cache->set('done1', $done1);
            }

            $like1 = $this->getCount('like1', 1, 1, $cacheTime);
            $friend1 = $this->getCount('friend1', 2, 1, $cacheTime);
            $subscriber1 = $this->getCount('subscriber1', 3, 1, $cacheTime);
            $repost1 = $this->getCount('repost1', 4, 1, $cacheTime);
            $comment1 = $this->getCount('comment1', 5, 1, $cacheTime);
            $interview1 = $this->getCount('interview1', 6, 1, $cacheTime);

            if (\Yii::$app->cache->exists('sum1'))
                $sum1 = \Yii::$app->cache->get('sum1');
            else {
                $sum1 = Order::getDb()->cache(function () {
                    return Order::find()
                        ->where(['>', 'date', mktime(strftime('-1 day', time()))])
                        ->count();
                }, $cacheTime);

                \Yii::$app->cache->set('sum1', $sum1);
            }

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

            $done7 = '';
            if (\Yii::$app->cache->exists('done7'))
                $done7 = \Yii::$app->cache->get('done7');
            else {
                $done7 = Order::getDb()->cache(function () {
                    return Order::find(['status' => Order::DONE])
                        ->where(['>', 'date', mktime(strftime('-7 day', time()))])
                        ->count();
                }, $cacheTime);

                \Yii::$app->cache->set('done7', $done7);
            }

            $like7 = $this->getCount('like7', 1, 7, $cacheTime);
            $friend7 = $this->getCount('friend7', 2, 7, $cacheTime);
            $subscriber7 = $this->getCount('subscriber7', 3, 7, $cacheTime);
            $repost7 = $this->getCount('repost7', 4, 7, $cacheTime);
            $comment7 = $this->getCount('comment7', 5, 7, $cacheTime);
            $interview7 = $this->getCount('interview7', 6, 7, $cacheTime);


            $sum7 = '';
            if (\Yii::$app->cache->exists('sum7'))
                $sum7 = \Yii::$app->cache->get('sum7');
            else {
                $sum7 = Order::getDb()->cache(function () {
                    return Order::find()
                        ->where(['>', 'date', mktime(strftime('-7 day', time()))])
                        ->count();
                }, $cacheTime);

                \Yii::$app->cache->set('sum7', $sum7);
            }

            return [
                'done7'       => isset($done7) ? $done7 : 0,
                'like7'       => isset($like7) ? $like7 : 0,
                'repost7'     => isset($repost7) ? $repost7 : 0,
                'subscriber7' => isset($subscriber7) ? $subscriber7 : 0,
                'friend7'     => isset($friend7) ? $friend7 : 0,
                'comment7'    => isset($comment7) ? $comment7 : 0,
                'interview7'  => isset($interview7) ? $interview7 : 0,
                'sum7'        => isset($sum7) ? $sum7 : 0,
            ];
        }

        private function getStatistics30()
        {
            $cacheTime = 60 * 60 * 24;

            $done30 = '';
            if (\Yii::$app->cache->exists('done30'))
                $done30 = \Yii::$app->cache->get('done30');
            else {
                $done30 = Order::getDb()->cache(function () {
                    return Order::find(['status' => Order::DONE])
                        ->where(['>', 'date', mktime(strftime('-30 day', time()))])
                        ->count();
                }, $cacheTime);

                \Yii::$app->cache->set('done30', $done30);
            }

            $like30 = $this->getCount('like30', 1, 30, $cacheTime);
            $friend30 = $this->getCount('friend30', 2, 30, $cacheTime);
            $subscriber30 = $this->getCount('subscriber30', 3, 30, $cacheTime);
            $repost30 = $this->getCount('repost30', 4, 30, $cacheTime);
            $comment30 = $this->getCount('comment30', 5, 30, $cacheTime);
            $interview30 = $this->getCount('interview30', 6, 30, $cacheTime);


            $sum30 = '';
            if (\Yii::$app->cache->exists('sum30'))
                $sum30 = \Yii::$app->cache->get('sum30');
            else {
                $sum30 = Order::getDb()->cache(function () {
                    return Order::find()
                        ->where(['>', 'date', mktime(strftime('-30 day', time()))])
                        ->count();
                }, $cacheTime);

                \Yii::$app->cache->set('sum30', $sum30);
            }

            return [
                'done30'       => isset($done30) ? $done30 : 0,
                'like30'       => isset($like30) ? $like30 : 0,
                'repost30'     => isset($repost30) ? $repost30 : 0,
                'subscriber30' => isset($subscriber30) ? $subscriber30 : 0,
                'friend30'     => isset($friend30) ? $friend30 : 0,
                'comment30'    => isset($comment30) ? $comment30 : 0,
                'interview30'  => isset($interview30) ? $interview30 : 0,
                'sum30'        => isset($sum30) ? $sum30 : 0,
            ];
        }

        private function getStatisticsAll()
        {
            $cacheTime = 60 * 60 * 24;

            $doneAll = '';
            if (\Yii::$app->cache->exists('doneAll'))
                $doneAll = \Yii::$app->cache->get('doneAll');
            else {
                $doneAll = Order::getDb()->cache(function () {
                    return Order::find(['status' => Order::DONE])->count();
                }, $cacheTime);

                \Yii::$app->cache->set('doneAll', $doneAll);
            }

            $likeAll = $this->getCountAll('likeAll', 1, $cacheTime);
            $friendAll = $this->getCountAll('friendAll', 2, $cacheTime);
            $subscriberAll = $this->getCountAll('subscriberAll', 3, $cacheTime);
            $repostAll = $this->getCountAll('repostAll', 4, $cacheTime);
            $commentAll = $this->getCountAll('commentAll', 5, $cacheTime);
            $interviewAll = $this->getCountAll('interviewAll', 6, $cacheTime);


            $sumAll = '';
            if (\Yii::$app->cache->exists('sumAll'))
                $sumAll = \Yii::$app->cache->get('sumAll');
            else {
                $sumAll = Order::getDb()->cache(function () {
                    return Order::find()->count();
                }, $cacheTime);

                \Yii::$app->cache->set('sumAll', $sumAll);
            }

            return [
                'doneAll'       => isset($doneAll) ? $doneAll : 0,
                'likeAll'       => isset($likeAll) ? $likeAll : 0,
                'repostAll'     => isset($repostAll) ? $repostAll : 0,
                'subscriberAll' => isset($subscriberAll) ? $subscriberAll : 0,
                'friendAll'     => isset($friendAll) ? $friendAll : 0,
                'commentAll'    => isset($commentAll) ? $commentAll : 0,
                'interviewAll'  => isset($interviewAll) ? $interviewAll : 0,
                'sumAll'        => isset($sumAll) ? $sumAll : 0,
            ];
        }

        private function getCount($type, $kind, $days, $cacheTime)
        {
            $result = '';
            if (\Yii::$app->cache->exists($type))
                $result = \Yii::$app->cache->get($type);
            else {
                $result = Order::getDb()->cache(function () use($kind, $days) {
                    $time = "-" . $days . " day";

                    return Order::find(['status' => Order::DONE])
                        ->where(['>', 'date', mktime(strftime($time, time()))])
                        ->andWhere(['kind' => $kind])
                        ->sum('members_count');
                }, $cacheTime);

                \Yii::$app->cache->set($type, $result, $cacheTime / 2);
            }

            return $result;
        }
        private function getCountAll($type, $kind, $cacheTime)
        {
            $result = '';
            if (\Yii::$app->cache->exists($type))
                $result = \Yii::$app->cache->get($type);
            else {
                $result = Order::getDb()->cache(function ()  use($kind) {
                    return Order::find(['status' => Order::DONE])
                        ->where(['kind' => $kind])
                        ->sum('members_count');
                }, $cacheTime);

                \Yii::$app->cache->set($type, $result, $cacheTime / 2);
            }

            return $result;
        }
    }