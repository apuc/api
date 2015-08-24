<?php

    namespace backend\modules\api\classes;


    use common\models\db\Order;
    use common\models\db\Service;

    abstract class Api implements ApiInterface
    {
        protected static $token = false;

        public static function getUserInfo()
        {
            self::checkToken();

            return json_decode(file_get_contents('https://like4u.ru/client/user_info.json?token=' . self::$token));
        }

        protected static function checkToken()
        {
            if (self::$token === false) {
                self::$token = \Yii::$app->params['like4uAccessToken'];
            }
        }

        public static function setTaskByNetwork($model)
        {
            $network = $model->service->network;

            $id = NULL;

            if ($network == Service::VK)
                $id = VK::setTask($model);
            elseif ($network == Service::INSTAGRAM)
                $id = Instagram::setTask($model);
            elseif ($network == Service::TWITTER)
                $id = Twitter::setTask($model);
            elseif ($network == Service::ASKFM)
                $id = AskFM::setTask($model);

            return $id;
        }

        public static function deleteTaskByNetwork($model)
        {
            $network = $model->service->network;
            $id = null;
            if ($network == Service::VK)
                $id = VK::deleteTask($model->foreign_id);
            if ($network == Service::INSTAGRAM)
                $id = Instagram::deleteTask($model->foreign_id);
            if ($network == Service::TWITTER)
                $id = Twitter::deleteTask($model->foreign_id);
            if ($network == Service::ASKFM)
                $id = AskFM::deleteTask($model->foreign_id);

            return $id;
        }

        /**
         * @param Order $model
         * @return array
         */
        public static function getQueryParams($model)
        {
            $network = $model->service->network;

            if ($network === Service::VK)
                return self::getVKSetParams($model);

            if ($network === Service::INSTAGRAM)
                return self::getInstagramSetParams($model);

            if ($network === Service::TWITTER)
                return self::getTwitterSetParams($model);

            if ($network === Service::ASKFM)
                return self::getAskFMSetParams($model);
        }

        protected static function getVKSetParams($model)
        {
            $query = [];
            $task = [];
            $task_limit = [];

            $text = $model->title;

            $task['kind'] = $model->kind;
            $task['title'] = iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
            $task['url'] = $model->url;
            $task['members_count'] = $model->members_count;
            $task['cost'] = $model->cost;
            $task['tag_list'] = $model->tag_list;
            $task['sex'] = trim($model->sex);
            $task['age_min'] = $model->age_min;
            $task['age_max'] = $model->age_max;
            $task['friends_count'] = $model->friends_count;
            $task['country'] = $model->country;
            $task['city_text'] = $model->city_text;
            $task['city'] = $model->city;

            $task_limit['minute_1'] = $model->minute_1;
            $task_limit['minutes_5'] = $model->minutes_5;
            $task_limit['hour_1'] = $model->hour_1;
            $task_limit['hours_4'] = $model->hours_4;
            $task_limit['day_1'] = $model->day_1;

            $query['task_limit'] = $task_limit;

            $query['task'] = $task;

            return $query;
        }

        protected static function getInstagramSetParams($model)
        {
            return self::getInstOrTwitterOrAskFMSetParams($model);
        }

        protected static function getInstOrTwitterOrAskFMSetParams($model)
        {
            $task = [];
            $task_limit = [];

            $text = $model->title;

            $task['title'] = iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
            $task['url'] = $model->url;
            $task['members_count'] = $model->members_count;
            $task['cost'] = $model->cost;
            $task['tag_list'] = $model->tag_list;
            $task['min_followers'] = $model->min_followers;
            $task['min_media'] = $model->min_media;
            $task['has_avatar'] = $model->has_avatar;

            $task_limit['minute_1'] = $model->minute_1;
            $task_limit['minutes_5'] = $model->minutes_5;
            $task_limit['hour_1'] = $model->hour_1;
            $task_limit['hours_4'] = $model->hours_4;
            $task_limit['day_1'] = $model->day_1;

            $task['task_limit_attributes'] = $task_limit;

            return $task;
        }

        protected static function getTwitterSetParams($model)
        {
            return self::getInstOrTwitterOrAskFMSetParams($model);
        }

        protected static function getAskFMSetParams($model)
        {
            return self::getInstOrTwitterOrAskFMSetParams($model);
        }
    }