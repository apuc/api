<?php

    namespace backend\modules\api\classes;


    abstract class Api implements ApiInterface
    {
        protected static $token = false;

        public static function getUserInfo()
        {
            self::checkToken();

            return json_decode(file_get_contents('https://like4u.ru/client/user_info.json?token=' . self::$token));
        }

        protected static function checkToken(){
            if (self::$token === false) {
                self::$token = \Yii::$app->params['like4uAccessToken'];
            }
        }
    }