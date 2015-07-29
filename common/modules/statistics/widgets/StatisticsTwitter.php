<?php
    namespace common\modules\statistics\widgets;

    use common\models\db\Service;
    use common\modules\statistics\models\Order;
    use common\modules\statistics\widgets\classes\Counter;
    use yii\base\Widget;

    class StatisticsTwitter extends Widget
    {
        use Counter;

        public function run()
        {
            $statsForOneDayTwit = $this->getStatistics1();
            $statsForSevenDaysTwit = $this->getStatistics7();
            $statsForOneMonthTwit = $this->getStatistics30();
            $statsForAllTimeTwit = $this->getStatisticsAll();

            return $this->render('TWITTER', [
                'statsForOneDayTwit'    => $statsForOneDayTwit,
                'statsForSevenDaysTwit' => $statsForSevenDaysTwit,
                'statsForOneMonthTwit'  => $statsForOneMonthTwit,
                'statsForAllTimeTwit'   => $statsForAllTimeTwit,
            ]);
        }

        private function getStatistics1()
        {
            $cacheTime = \Yii::$app->params['statsWidgetCacheTime'];

            $stat1 = '';

            if (\Yii::$app->cache->exists('statTwit1'))
                $stat1 = \Yii::$app->cache->get('statTwit1');
            else {
                $done1 = Order::getDb()->cache(function () {
                    return Order::find(['status' => Order::DONE])
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::TWITTER)
                        ->andWhere(['>', 'date', mktime(strftime('-1 day', time()))])
                        ->count();
                }, $cacheTime);

                $retwit1 = $this->getCount('retwit1', Service::RETWIT_TWITTER, 1, $cacheTime);
                $subscriber1 = $this->getCount('subscriber1', Service::SUBSCRIBER_TWITTER, 1, $cacheTime);
                $favorite1 = $this->getCount('favorite1', Service::FAVORITE_TWITTER, 1, $cacheTime);

                $sum1 = Order::getDb()->cache(function () {
                    return Order::find()
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::TWITTER)
                        ->andWhere(['>', 'date', mktime(strftime('-1 day', time()))])
                        ->sum('sum');
                }, $cacheTime);

                $stat1 = [
                    'done1'       => isset($done1) ? $done1 : 0,
                    'retwit1'       => isset($retwit1) ? $retwit1 : 0,
                    'subscriber1' => isset($subscriber1) ? $subscriber1 : 0,
                    'favorite1'     => isset($favorite1) ? $favorite1 : 0,
                    'sum1'     => isset($sum1) ? $sum1 : 0,
                ];

                \Yii::$app->cache->set('statTwit1', $stat1);
            }


            return $stat1;
        }

        private function getStatistics7()
        {
            $cacheTime = \Yii::$app->params['statsWidgetCacheTime'];

            $stat7 = '';

            if (\Yii::$app->cache->exists('statTwit7'))
                $stat7 = \Yii::$app->cache->get('statTwit7');
            else {
                $done7 = Order::getDb()->cache(function () {
                    return Order::find(['status' => Order::DONE])
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::TWITTER)
                        ->andWhere(['>', 'date', mktime(strftime('-7 day', time()))])
                        ->count();
                }, $cacheTime);

                $retwit7 = $this->getCount('retwit7', Service::RETWIT_TWITTER, 7, $cacheTime);
                $subscriber7 = $this->getCount('subscriber7', Service::SUBSCRIBER_TWITTER, 7, $cacheTime);
                $favorite7 = $this->getCount('favorite7', Service::FAVORITE_TWITTER, 7, $cacheTime);

                $sum7 = Order::getDb()->cache(function () {
                    return Order::find()
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::TWITTER)
                        ->andWhere(['>', 'date', mktime(strftime('-7 day', time()))])
                        ->sum('sum');
                }, $cacheTime);

                $stat7 = [
                    'done7'       => isset($done7) ? $done7 : 0,
                    'retwit7'       => isset($retwit7) ? $retwit7 : 0,
                    'subscriber7' => isset($subscriber7) ? $subscriber7 : 0,
                    'favorite7'     => isset($favorite7) ? $favorite7 : 0,
                    'sum7'        => isset($sum7) ? $sum7 : 0,
                ];

                \Yii::$app->cache->set('statTwit7', $stat7);
            }


            return $stat7;
        }

        private function getStatistics30()
        {
            $cacheTime = \Yii::$app->params['statsWidgetCacheTime'];

            $stat30 = '';

            if (\Yii::$app->cache->exists('statTwit30'))
                $stat30 = \Yii::$app->cache->get('statTwit30');
            else {
                $done30 = Order::getDb()->cache(function () {
                    return Order::find(['status' => Order::DONE])
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::TWITTER)
                        ->andWhere(['>', 'date', mktime(strftime('-30 day', time()))])
                        ->count();
                }, $cacheTime);

                $retwit30 = $this->getCount('retwit30', Service::RETWIT_TWITTER, 30, $cacheTime);
                $subscriber30 = $this->getCount('subscriber30', Service::SUBSCRIBER_TWITTER, 30, $cacheTime);
                $favorite30 = $this->getCount('favorite30', Service::FAVORITE_TWITTER, 30, $cacheTime);

                $sum30 = Order::getDb()->cache(function () {
                    return Order::find()
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::TWITTER)
                        ->andWhere(['>', 'date', mktime(strftime('-30 day', time()))])
                        ->sum('sum');
                }, $cacheTime);

                $stat30 = [
                    'done30'       => isset($done30) ? $done30 : 0,
                    'retwit30'       => isset($retwit30) ? $retwit30 : 0,
                    'subscriber30' => isset($subscriber30) ? $subscriber30 : 0,
                    'favorite30'     => isset($favorite30) ? $favorite30 : 0,
                    'sum30'        => isset($sum30) ? $sum30 : 0,
                ];

                \Yii::$app->cache->set('statTwit30', $stat30);
            }


            return $stat30;
        }

        private function getStatisticsAll()
        {
            $cacheTime = \Yii::$app->params['statsWidgetCacheTime'];

            $statAll = '';

            if (\Yii::$app->cache->exists('statTwitAll'))
                $statAll = \Yii::$app->cache->get('statTwitAll');
            else {
                $doneAll = Order::getDb()->cache(function () {
                    return Order::find(['status' => Order::DONE])
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::TWITTER)
                        ->sum('order.sum');
                }, $cacheTime);

                $retwitAll = $this->getCountAll('retwitAll', Service::RETWIT_TWITTER, $cacheTime);
                $subscriberAll = $this->getCountAll('subscriberAll', Service::SUBSCRIBER_TWITTER, $cacheTime);
                $favoriteAll = $this->getCountAll('favoriteAll', Service::FAVORITE_TWITTER, $cacheTime);

                $sumAll = Order::getDb()->cache(function () {
                    return Order::find()
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::TWITTER)
                        ->sum('sum');
                }, $cacheTime);

                $statAll = [
                    'doneAll'       => isset($doneAll) ? $doneAll : 0,
                    'retwitAll'       => isset($retwitAll) ? $retwitAll : 0,
                    'subscriberAll' => isset($subscriberAll) ? $subscriberAll : 0,
                    'favoriteAll'     => isset($favoriteAll) ? $favoriteAll : 0,
                    'sumAll'        => isset($sumAll) ? $sumAll : 0,
                ];

                \Yii::$app->cache->set('statTwitAll', $statAll);
            }

            return $statAll;
        }
    }