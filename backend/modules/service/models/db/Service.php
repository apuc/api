<?php

    namespace backend\modules\service\models\db;

    class Service extends \common\models\db\Service
    {
        public function rules()
        {
            return [
                [['model_name', 'name', 'minimum_all_likes', 'minimum_tasks', 'minimum_likes_per_task',
                  'price_per_one_task'], 'required'],
                [['minimum_all_likes', 'minimum_tasks', 'minimum_likes_per_task'], 'integer'],
                [['price_per_one_task', 'minimum_price_per_task'], 'number'],
                [['model_name', 'name'], 'string', 'max' => 255],

                ['minimum_tasks', 'integer', 'min' => 10, 'on' => ['LikeVK',
                                                                   'LikeInstagram',
                                                                   'SubscriberInstagram',
                                                                   'SubscriberTwitter',
                                                                   'RetwitTwitter',
                                                                   'FavoriteTwitter',
                                                                   'LikeAskFM',]
                ],
                ['minimum_likes_per_task', 'integer', 'min' => 1, 'on' => ['LikeVK',
                                                                           'LikeInstagram',
                                                                           'RetwitTwitter',
                                                                           'FavoriteTwitter',
                                                                           'LikeAskFM',]
                ],

                ['minimum_likes_per_task', 'integer', 'min' => 2, 'on' => ['SubscriberVK', 'SubscriberTwitter']],
                ['minimum_all_likes', 'integer', 'min' => 50, 'on' => 'SubscriberVK'],

                ['minimum_likes_per_task', 'integer', 'min' => 3, 'on' => 'SubscriberInstagram'],

                ['minimum_likes_per_task', 'integer', 'min' => 5, 'on' => ['FriendVK', 'RepostVK', 'CommentVK']],
                ['minimum_all_likes', 'integer', 'min' => 50, 'on' => ['FriendVK', 'RepostVK', 'CommentVK']],

                ['minimum_likes_per_task', 'integer', 'min' => 5, 'on' => 'InterviewVK'],
                ['minimum_all_likes', 'integer', 'min' => 50, 'on' => 'InterviewVK'],
            ];
        }
    }