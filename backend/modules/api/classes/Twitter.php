<?php

    namespace backend\modules\api\classes;


    use common\classes\Debag;
    use common\models\db\Service;
    use yii\helpers\Html;

    class Twitter extends Api
    {
        static function setTask($model)
        {
            self::checkToken();



            if ($model->service_id === Service::FAVORITE_TWITTER)
                return self::setFavoritesTask($model->getQueryParams());

            if ($model->service_id === Service::SUBSCRIBER_TWITTER)
                return self::setSubscriberTask($model->getQueryParams());

            return self::setRetwitTask($model->getQueryParams());
        }

        protected static function setRetwitTask($params){
            $query['token'] = self::$token;
            $query['tw_retweet_task'] = $params;

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, 'https://like4u.ru/likes/twitter/retweets.json');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($query));

            $result = curl_exec($curl);

            curl_close($curl);
            $resultObj = json_decode($result);
            $id = $resultObj->id ? $resultObj->id : false;

            return $id;
        }

        protected static function setSubscriberTask($params){
            $query['token'] = self::$token;
            $query['tw_follow_task'] = $params;

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, 'https://like4u.ru/likes/twitter/follows.json');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($query));

            $result = curl_exec($curl);

            curl_close($curl);

            $resultObj = json_decode($result);
            $id = $resultObj->id ? $resultObj->id : false;

            return $id;
        }

        protected static function setFavoritesTask($params){
            $query['token'] = self::$token;
            $query['tw_favorite_task'] = $params;

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, 'https://like4u.ru/likes/twitter/favorites.json');
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

            $result = file_get_contents('https://like4u.ru/likes/twitter/tasks.json?token=' . self::$token);

            return json_decode($result);
        }

        /**
         * @param integer $id
         * @return mixed
         */
        static function getTask($id)
        {
            self::checkToken();

            return json_decode(file_get_contents('https://like4u.ru/twitter/tasks/' . $id . '.json?token=' . self::$token));
        }

        /**
         * @param integer $id
         * @return mixed
         */
        static function deleteTask($id)
        {
            self::checkToken();

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, 'https://like4u.ru/twitter/tasks/' . $id . '.json?token=' . self::$token);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($curl);

            curl_close($curl);

            return json_decode($result);
        }
    }