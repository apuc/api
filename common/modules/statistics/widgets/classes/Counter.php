<?php
    namespace common\modules\statistics\widgets\classes;

    use common\modules\statistics\models\Order;

    trait Counter
    {
        private function getCount($type, $kind, $days, $cacheTime)
        {
            $result = Order::getDb()->cache(function () use ($kind, $days) {
                $time = "-" . $days . " day";

                return Order::find(['status' => Order::DONE])
                    ->where(['>', 'date', mktime(strftime($time, time()))])
                    ->andWhere(['kind' => $kind])
                    ->sum('members_count');
            }, $cacheTime);

            return $result;
        }

        private function getCountAll($type, $kind, $cacheTime)
        {
            $result = Order::getDb()->cache(function () use ($kind) {
                return Order::find(['status' => Order::DONE])
                    ->where(['kind' => $kind])
                    ->sum('members_count');
            }, $cacheTime);

            return $result;
        }
    }