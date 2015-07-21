<?php

    namespace backend\modules\api\classes;

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
         * @param $task Order
         * @return mixed id or false
         */
        public static function setTask($task)
        {
            $query = [];
            $task = [];
            $task_limit = [];

//            $query['token'] = self::$token;
//
//            $text = "��������� ��� ��������";
//
//            $task['kind'] = self::LIKE;
//            $task['title'] = iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
//            $task['url'] = "https://vk.com/club89526364?w=wall-89526364_3%2Fall";
//            $task['members_count'] = "10";
//            $task['cost'] = "1";
//            $task['tag_list'] = "";
//            $task['sex'] = "";
//            $task['age_min'] = "";
//            $task['age_max'] = "";
//            $task['friends_count'] = "";
//            $task['country'] = "";
//            $task['city_text'] = "";
//            $task['city'] = "";
//
//            $task_limit['minute_1'] = '';
//            $task_limit['minutes_5'] = '';
//            $task_limit['hour_1'] = '';
//            $task_limit['hours_4'] = '';
//            $task_limit['day_1'] = '';

            $query['task_limit'] = $task_limit;

            $query['task'] = $task;

            $curl = curl_init();

            //curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($curl, CURLOPT_URL, 'https://like4u.ru/tasks.json');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($query));

            $result = curl_exec($curl);

            curl_close($curl);

            //print_r(json_last_error_msg());

            return json_decode($result)->id ? json_decode($result)->id : false;
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