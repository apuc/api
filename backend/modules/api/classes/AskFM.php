<?php
    namespace backend\modules\api\classes;

    class AskFM extends Api
    {
        static function setTask($model)
        {
            self::checkToken();

            return self::setLikeTask(Api::getQueryParams($model));
        }


        protected static function setLikeTask($params)
        {
            $query['token'] = self::$token;
            $query['af_like_task'] = $params;

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, 'https://like4u.ru/likes/askfm/likes.json');
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
            $result = file_get_contents('https://like4u.ru/likes/askfm/tasks.json?token=' . self::$token);
            return json_decode($result);
        }

        /**
         * @param integer $id
         * @return mixed
         */
        static function getTask($id)
        {
            self::checkToken();

            return json_decode(file_get_contents('https://like4u.ru/likes/askfm/tasks/' . $id . '.json?token=' . self::$token));

        }

        /**
         * @param integer $id
         * @return mixed
         */
        static function deleteTask($id)
        {
            self::checkToken();

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, 'https://like4u.ru/likes/askfm/tasks/' . $id . '.json?token=' . self::$token);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($curl);

            curl_close($curl);

            return json_decode($result);
        }
    }