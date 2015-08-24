<?php

    namespace frontend\modules\promotion\models\forms;


    use yii\base\Model;

    class Twitter extends Model
    {
        public $title;
        public $url;

        public $members_count_retweet;
        public $cost_retweet;

        public $members_count_favorite;
        public $cost_favorite;

        public $tag_list;

        public $minute_1_retweet;
        public $minutes_5_retweet;
        public $hour_1_retweet;
        public $hours_4_retweet;
        public $day_1_retweet;

        public $minute_1_favorite;
        public $minutes_5_favorite;
        public $hour_1_favorite;
        public $hours_4_favorite;
        public $day_1_favorite;

        public $min_followers;
        public $min_media;
        public $has_avatar;
    }