<?php

    namespace common\modules\statistics\widgets;

    use common\models\db\Service;
    use common\modules\statistics\models\Order;
    use common\modules\statistics\widgets\classes\Counter;
    use yii\base\Widget;

    class StatisticsAsk extends Widget
    {
        use Counter;

        public function run()
        {
            $statsForOneDayAsk = $this->getStatistics1();
            $statsForSevenDaysAsk = $this->getStatistics7();
            $statsForOneMonthAsk = $this->getStatistics30();
            $statsForAllTimeAsk = $this->getStatisticsAll();

            return $this->render('ask', [
                'statsForOneDayAsk'    => $statsForOneDayAsk,
                'statsForSevenDaysAsk' => $statsForSevenDaysAsk,
                'statsForOneMonthAsk'  => $statsForOneMonthAsk,
                'statsForAllTimeAsk'   => $statsForAllTimeAsk,
            ]);
        }

        private function getStatistics1()
        {
            $cacheTime = \Yii::$app->params['statsWidgetCacheTime'];

            $stat1 = '';

            if (\Yii::$app->cache->exists('statAsk1'))
                $stat1 = \Yii::$app->cache->get('statAsk1');
            else {
                $done1 = Order::getDb()->cache(function () {
                    return Order::find(['status' => Order::DONE])
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::ASKFM)
                        ->andWhere(['>', 'date', mktime(strftime('-1 day', time()))])
                        ->count();
                }, $cacheTime);

                $like1 = $this->getCount('like1', Service::LIKE_ASKFM, 1, $cacheTime);

                $sum1 = Order::getDb()->cache(function () {
                    return Order::find()
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::ASKFM)
                        ->andWhere(['>', 'date', mktime(strftime('-1 day', time()))])
                        ->sum('sum');
                }, $cacheTime);

                $stat1 = [
                    'done1'       => isset($done1) ? $done1 : 0,
                    'like1'       => isset($like1) ? $like1 : 0,
                    'sum1'        => isset($sum1) ? $sum1 : 0,
                ];

                \Yii::$app->cache->set('statAsk1', $stat1);
            }


            return $stat1;
        }

        private function getStatistics7()
        {
            $cacheTime = \Yii::$app->params['statsWidgetCacheTime'];

            $stat7 = '';

            if (\Yii::$app->cache->exists('statAsk7'))
                $stat7 = \Yii::$app->cache->get('statAsk7');
            else {
                $done7 = Order::getDb()->cache(function () {
                    return Order::find(['status' => Order::DONE])
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::ASKFM)
                        ->andWhere(['>', 'date', mktime(strftime('-7 day', time()))])
                        ->count();
                }, $cacheTime);

                $like7 = $this->getCount('like7', Service::LIKE_ASKFM, 7, $cacheTime);

                $sum7 = Order::getDb()->cache(function () {
                    return Order::find()
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::ASKFM)
                        ->andWhere(['>', 'date', mktime(strftime('-7 day', time()))])
                        ->sum('sum');
                }, $cacheTime);

                $stat7 = [
                    'done7'       => isset($done7) ? $done7 : 0,
                    'like7'       => isset($like7) ? $like7 : 0,
                    'sum7'        => isset($sum7) ? $sum7 : 0,
                ];

                \Yii::$app->cache->set('statAsk7', $stat7);
            }


            return $stat7;
        }

        private function getStatistics30()
        {
            $cacheTime = \Yii::$app->params['statsWidgetCacheTime'];

            $stat30 = '';

            if (\Yii::$app->cache->exists('statAsk30'))
                $stat30 = \Yii::$app->cache->get('statAsk30');
            else {
                $done30 = Order::getDb()->cache(function () {
                    return Order::find(['status' => Order::DONE])
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::ASKFM)
                        ->andWhere(['>', 'date', mktime(strftime('-30 day', time()))])
                        ->count();
                }, $cacheTime);

                $like30 = $this->getCount('like30', Service::LIKE_ASKFM, 30, $cacheTime);

                $sum30 = Order::getDb()->cache(function () {
                    return Order::find()
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::ASKFM)
                        ->andWhere(['>', 'date', mktime(strftime('-30 day', time()))])
                        ->sum('sum');
                }, $cacheTime);

                $stat30 = [
                    'done30'       => isset($done30) ? $done30 : 0,
                    'like30'       => isset($like30) ? $like30 : 0,
                    'sum30'        => isset($sum30) ? $sum30 : 0,
                ];

                \Yii::$app->cache->set('statAsk30', $stat30);
            }


            return $stat30;
        }

        private function getStatisticsAll()
        {
            $cacheTime = \Yii::$app->params['statsWidgetCacheTime'];

            $statAll = '';

            if (\Yii::$app->cache->exists('statAskAll'))
                $statAll = \Yii::$app->cache->get('statAskAll');
            else {
                $doneAll = Order::getDb()->cache(function () {
                    return Order::find(['status' => Order::DONE])
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::ASKFM)
                        ->sum('order.sum');
                }, $cacheTime);

                $likeAll = $this->getCountAll('likeAll', Service::LIKE_ASKFM, $cacheTime);

                $sumAll = Order::getDb()->cache(function () {
                    return Order::find()
                        ->leftJoin('service', 'service.id = order.service_id')
                        ->where('service.network = ' . Service::ASKFM)
                        ->sum('sum');
                }, $cacheTime);

                $statAll = [
                    'doneAll'       => isset($doneAll) ? $doneAll : 0,
                    'likeAll'       => isset($likeAll) ? $likeAll : 0,
                    'sumAll'        => isset($sumAll) ? $sumAll : 0,
                ];

                \Yii::$app->cache->set('statAskAll', $statAll);
            }

            return $statAll;
        }
    }