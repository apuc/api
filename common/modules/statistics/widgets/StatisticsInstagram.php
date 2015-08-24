<?php

    namespace common\modules\statistics\widgets;

    use common\models\db\Service;
    use common\modules\statistics\models\Order;
    use common\modules\statistics\widgets\classes\Counter;
    use yii\base\Widget;

    class StatisticsInstagram extends Widget
    {
        use Counter;

        public function run()
        {
            $statsForOneDayIns = $this->getStatistics1();
            $statsForSevenDaysIns = $this->getStatistics7();
            $statsForOneMonthIns = $this->getStatistics30();
            $statsForAllTimeIns = $this->getStatisticsAll();

            return $this->render('instagram', [
                'statsForOneDayIns'    => $statsForOneDayIns,
                'statsForSevenDaysIns' => $statsForSevenDaysIns,
                'statsForOneMonthIns'  => $statsForOneMonthIns,
                'statsForAllTimeIns'   => $statsForAllTimeIns,
            ]);
        }

        private function getStatistics1()
        {
            $cacheTime = \Yii::$app->params['statsWidgetCacheTime'];

            $stat1 = '';

            if (\Yii::$app->cache->exists('statIns1'))
                $stat1 = \Yii::$app->cache->get('statIns1');
            else {
                $done1 = Order::getDb()->cache(function () {
                    return Order::find(['status' => [Order::DONE, Order::DONE_AND_HIDE]])
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::INSTAGRAM)
                        ->andWhere(['>', 'date', mktime(strftime('-1 day', time()))])
                        ->count();
                }, $cacheTime);

                $like1 = $this->getCount('like1', Service::LIKE_INSTAGRAM, 1, $cacheTime);
                $subscriber1 = $this->getCount('subscriber1', Service::SUBSCRIBER_INSTAGRAM, 1, $cacheTime);

                $sum1 = Order::getDb()->cache(function () {
                    return Order::find()
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::INSTAGRAM)
                        ->andWhere(['>', 'date', mktime(strftime('-1 day', time()))])
                        ->sum('sum');
                }, $cacheTime);

                $stat1 = [
                    'done1'       => isset($done1) ? $done1 : 0,
                    'like1'       => isset($like1) ? $like1 : 0,
                    'subscriber1' => isset($subscriber1) ? $subscriber1 : 0,
                    'sum1'        => isset($sum1) ? $sum1 : 0,
                ];

                \Yii::$app->cache->set('statIns1', $stat1);
            }


            return $stat1;
        }

        private function getStatistics7()
        {
            $cacheTime = \Yii::$app->params['statsWidgetCacheTime'];

            $stat7 = '';

            if (\Yii::$app->cache->exists('statIns7'))
                $stat7 = \Yii::$app->cache->get('statIns7');
            else {
                $done7 = Order::getDb()->cache(function () {
                    return Order::find(['status' => [Order::DONE, Order::DONE_AND_HIDE]])
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::INSTAGRAM)
                        ->andWhere(['>', 'date', mktime(strftime('-7 day', time()))])
                        ->count();
                }, $cacheTime);

                $like7 = $this->getCount('like7', Service::LIKE_INSTAGRAM, 7, $cacheTime);
                $subscriber7 = $this->getCount('subscriber7', Service::SUBSCRIBER_INSTAGRAM, 7, $cacheTime);

                $sum7 = Order::getDb()->cache(function () {
                    return Order::find()
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::INSTAGRAM)
                        ->andWhere(['>', 'date', mktime(strftime('-7 day', time()))])
                        ->sum('sum');
                }, $cacheTime);

                $stat7 = [
                    'done7'       => isset($done7) ? $done7 : 0,
                    'like7'       => isset($like7) ? $like7 : 0,
                    'subscriber7' => isset($subscriber7) ? $subscriber7 : 0,
                    'sum7'        => isset($sum7) ? $sum7 : 0,
                ];

                \Yii::$app->cache->set('statIns7', $stat7);
            }


            return $stat7;
        }

        private function getStatistics30()
        {
            $cacheTime = \Yii::$app->params['statsWidgetCacheTime'];

            $stat30 = '';

            if (\Yii::$app->cache->exists('statIns30'))
                $stat30 = \Yii::$app->cache->get('statIns30');
            else {
                $done30 = Order::getDb()->cache(function () {
                    return Order::find(['status' => [Order::DONE, Order::DONE_AND_HIDE]])
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::INSTAGRAM)
                        ->andWhere(['>', 'date', mktime(strftime('-30 day', time()))])
                        ->count();
                }, $cacheTime);

                $like30 = $this->getCount('like30', Service::LIKE_INSTAGRAM, 30, $cacheTime);
                $subscriber30 = $this->getCount('subscriber30', Service::SUBSCRIBER_INSTAGRAM, 30, $cacheTime);

                $sum30 = Order::getDb()->cache(function () {
                    return Order::find()
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::INSTAGRAM)
                        ->andWhere(['>', 'date', mktime(strftime('-30 day', time()))])
                        ->sum('sum');
                }, $cacheTime);

                $stat30 = [
                    'done30'       => isset($done30) ? $done30 : 0,
                    'like30'       => isset($like30) ? $like30 : 0,
                    'subscriber30' => isset($subscriber30) ? $subscriber30 : 0,
                    'sum30'        => isset($sum30) ? $sum30 : 0,
                ];

                \Yii::$app->cache->set('statIns30', $stat30);
            }


            return $stat30;
        }

        private function getStatisticsAll()
        {
            $cacheTime = \Yii::$app->params['statsWidgetCacheTime'];

            $statAll = '';

            if (\Yii::$app->cache->exists('statInsAll'))
                $statAll = \Yii::$app->cache->get('statInsAll');
            else {
                $doneAll = Order::getDb()->cache(function () {
                    return Order::find(['status' => [Order::DONE, Order::DONE_AND_HIDE]])
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::INSTAGRAM)
                        ->sum('order.sum');
                }, $cacheTime);

                $likeAll = $this->getCountAll('likeAll', Service::LIKE_INSTAGRAM, $cacheTime);
                $subscriberAll = $this->getCountAll('subscriberAll', Service::SUBSCRIBER_INSTAGRAM, $cacheTime);

                $sumAll = Order::getDb()->cache(function () {
                    return Order::find()
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::INSTAGRAM)
                        ->sum('sum');
                }, $cacheTime);

                $statAll = [
                    'doneAll'       => isset($doneAll) ? $doneAll : 0,
                    'likeAll'       => isset($likeAll) ? $likeAll : 0,
                    'subscriberAll' => isset($subscriberAll) ? $subscriberAll : 0,
                    'sumAll'        => isset($sumAll) ? $sumAll : 0,
                ];

                \Yii::$app->cache->set('statInsAll', $statAll);
            }

            return $statAll;
        }
    }