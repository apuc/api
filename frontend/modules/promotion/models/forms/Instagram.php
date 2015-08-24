<?php

    namespace frontend\modules\promotion\models\forms;


    use yii\base\Model;

    class Instagram extends Model
    {
        public $title;
        public $url;

        public $members_count_like;
        public $cost_like;

        public $tag_list;

        public $minute_1_like;
        public $minutes_5_like;
        public $hour_1_like;
        public $hours_4_like;
        public $day_1_like;

        public $min_followers;
        public $min_media;
        public $has_avatar;
    }