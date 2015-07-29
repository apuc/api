<?php

    namespace backend\modules\api\classes;

    use common\classes\Debag;
    use common\models\db\Service;

    class Instagram extends Api
    {
        static function setTask($model)
        {
            self::checkToken();

            if ($model->service_id === Service::SUBSCRIBER_INSTAGRAM)
                return self::setSubscriberTask($model->getQueryParams());

            return self::setLikeTask($model->getQueryParams());
        }

        protected static function setSubscriberTask($params)
        {
            $query['token'] = self::$token;
            $query['ig_follow_task'] = $params;

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, 'https://like4u.ru/likes/instagram/follows.json');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($query));

            $result = curl_exec($curl);

            curl_close($curl);

            $resultObj = json_decode($result);
            $id = $resultObj->id ? $resultObj->id : false;

            return $id;
        }

        protected static function setLikeTask($params)
        {
            $query['token'] = self::$token;
            $query['ig_like_task'] = $params;

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, 'https://like4u.ru/likes/instagram/likes.json');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($query));

            $result = curl_exec($curl);

            curl_close($curl);

            $resultObj = json_decode($result);
            $id = $resultObj->id ? $resultObj->id : false;

            return $id;
        }

        static function getTasks()
        {
            self::checkToken();

            $result = file_get_contents('https://like4u.ru/likes/instagram/tasks.json?token=' . self::$token);

            return json_decode($result);
        }

        static function getTask($id)
        {
            self::checkToken();

            return json_decode(file_get_contents('https://like4u.ru/instagram/tasks/' . $id . '.json?token=' . self::$token));
        }

        static function deleteTask($id)
        {
            self::checkToken();

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, 'https://like4u.ru/instagram/tasks/' . $id . '.json?token=' . self::$token);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($curl);

            curl_close($curl);

            return json_decode($result);
        }
    }