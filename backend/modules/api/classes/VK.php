<?php

    namespace backend\modules\api\classes;

    use common\classes\Debag;
    use common\models\db\Order;
    use yii\base\Object;

    class VK
    {
        const LIKE = 1;

        private static $token = 'a2e1b443299068f68e49e39c1ccff3fa';

        public static function getUserInfo()
        {
            return json_decode(file_get_contents('https://like4u.ru/client/user_info.json?token=' . self::$token));
        }

        /**
         * @param $model Order
         * @return mixed id or false
         */
        public static function setTask($model)
        {
            $query = $model->getArray();
            $query['token'] = self::$token;

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, 'https://like4u.ru/tasks.json');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($query));

            $result = curl_exec($curl);

            curl_close($curl);
            $resultObj = json_decode($result);
            $id = $resultObj->id ? $resultObj->id : false;
            return $id;
        }

        public static function getTasks()
        {
            $result = file_get_contents('https://like4u.ru/tasks.json?token=' . self::$token);

            return json_decode($result);
        }

        public static function getTask($id)
        {
            return json_decode(file_get_contents('https://like4u.ru/tasks/' . $id . '.json?token=' . self::$token));
        }

        public static function deleteTask($id)
        {
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, 'https://like4u.ru/tasks/' . $id . '.json?token=' . self::$token);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($curl);

            curl_close($curl);

            return json_decode($result);
        }
    }