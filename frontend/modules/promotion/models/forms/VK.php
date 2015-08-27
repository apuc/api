<?php

    namespace frontend\modules\promotion\models\forms;

    use common\classes\VKApi;
    use common\models\db\Promotion;
    use common\models\db\Service;
    use common\models\db\Task;
    use Exception;
    use yii\base\ErrorException;
    use yii\base\Model;

    class VK extends Model
    {
        //public $kind;
        public $id;
        public $title;
        public $url;

        public $members_count_like;
        public $cost_like;

        public $members_count_repost;
        public $cost_repost;

        public $members_count_comment;
        public $cost_comment;

        public $tag_list;
        public $sex;
        public $age_min;
        public $age_max;
        public $friends_count;
        public $country;
        public $city_text;
        public $city;

        public $minute_1_like;
        public $minutes_5_like;
        public $hour_1_like;
        public $hours_4_like;
        public $day_1_like;

        public $minute_1_repost;
        public $minutes_5_repost;
        public $hour_1_repost;
        public $hours_4_repost;
        public $day_1_repost;

        public $minute_1_comment;
        public $minutes_5_comment;
        public $hour_1_comment;
        public $hours_4_comment;
        public $day_1_comment;

        public $isNewRecord = true;

        public function __construct($id = null)
        {
            if ($id) {
                $this->isNewRecord = false;
                $this->id = $id;

                $userId = \Yii::$app->user->getId();

                $promotion = Promotion::findOne(['id' => $id]);

                if ($userId != $promotion->user_id)
                    throw new ErrorException();

                $this->url = $promotion->url;

                $tasks = $promotion->tasks;

                foreach ($tasks as $task) {
                    $query = json_decode($task->task, true);

                    if ($query['task']['kind'] == Service::LIKE_VK) {
                        $this->setLikeAttributes($query);
                        break;
                    }
                }
                foreach ($tasks as $task) {
                    $query = json_decode($task->task, true);

                    if ($query['task']['kind'] == Service::REPOST_VK) {
                        $this->setRepostAttributes($query);
                        break;
                    }
                }
                foreach ($tasks as $task) {
                    $query = json_decode($task->task, true);

                    if ($query['task']['kind'] == Service::COMMENT_VK) {
                        $this->setCommentAttributes($query);
                        break;
                    }
                }
            }
        }

        protected function setLikeAttributes($query)
        {
            $this->title = $query['task']['title'];
            $this->members_count_like = $query['task']['members_count'];
            $this->tag_list = $query['task']['tag_list'];
            $this->sex = $query['task']['sex'];
            $this->age_min = $query['task']['age_min'];
            $this->age_max = $query['task']['age_max'];
            $this->friends_count = $query['task']['friends_count'];
            $this->country = $query['task']['country'];
            $this->city_text = $query['task']['city_text'];
            $this->city = $query['task']['city'];


            $this->minute_1_like = $query['task_limit']['minute_1'];
            $this->minutes_5_like = $query['task_limit']['minutes_5'];
            $this->hour_1_like = $query['task_limit']['hour_1'];
            $this->hours_4_like = $query['task_limit']['hours_4'];
            $this->day_1_like = $query['task_limit']['day_1'];
        }

        protected function setRepostAttributes($query)
        {
            $this->title = $query['task']['title'];
            $this->members_count_repost = $query['task']['members_count'];
            $this->tag_list = $query['task']['tag_list'];
            $this->sex = $query['task']['sex'];
            $this->age_min = $query['task']['age_min'];
            $this->age_max = $query['task']['age_max'];
            $this->friends_count = $query['task']['friends_count'];
            $this->country = $query['task']['country'];
            $this->city_text = $query['task']['city_text'];
            $this->city = $query['task']['city'];


            $this->minute_1_repost = $query['task_limit']['minute_1'];
            $this->minutes_5_repost = $query['task_limit']['minutes_5'];
            $this->hour_1_repost = $query['task_limit']['hour_1'];
            $this->hours_4_repost = $query['task_limit']['hours_4'];
            $this->day_1_repost = $query['task_limit']['day_1'];
        }

        protected function setCommentAttributes($query)
        {
            $this->title = $query['task']['title'];
            $this->members_count_comment = $query['task']['members_count'];
            $this->tag_list = $query['task']['tag_list'];
            $this->sex = $query['task']['sex'];
            $this->age_min = $query['task']['age_min'];
            $this->age_max = $query['task']['age_max'];
            $this->friends_count = $query['task']['friends_count'];
            $this->country = $query['task']['country'];
            $this->city_text = $query['task']['city_text'];
            $this->city = $query['task']['city'];


            $this->minute_1_comment = $query['task_limit']['minute_1'];
            $this->minutes_5_comment = $query['task_limit']['minutes_5'];
            $this->hour_1_comment = $query['task_limit']['hour_1'];
            $this->hours_4_comment = $query['task_limit']['hours_4'];
            $this->day_1_comment = $query['task_limit']['day_1'];
        }

        public function rules()
        {
            return [
                [['title', 'url', 'members_count_like', 'cost_like', 'members_count_repost',
                    'cost_repost', 'members_count_comment', 'cost_comment', 'tag_list',
                    'sex', 'age_min', 'age_max', 'friends_count',
                    'country', 'city_text', 'city', 'minute_1_like',
                    'minutes_5_like', 'hour_1_like', 'hours_4_like',
                    'day_1_like', 'minute_1_repost', 'minutes_5_repost',
                    'hour_1_repost', 'hours_4_repost', 'day_1_repost', 'minute_1_comment',
                    'minutes_5_comment', 'hour_1_comment', 'hours_4_comment', 'day_1_comment',], 'trim'],

                [['members_count_like', 'cost_like', 'members_count_repost',
                    'cost_repost', 'members_count_comment', 'cost_comment',
                    'sex', 'age_min', 'age_max', 'friends_count',
                    'country', 'minute_1_like', 'minutes_5_like', 'hour_1_like', 'hours_4_like',
                    'day_1_like', 'minute_1_repost', 'minutes_5_repost',
                    'hour_1_repost', 'hours_4_repost', 'day_1_repost', 'minute_1_comment',
                    'minutes_5_comment', 'hour_1_comment', 'hours_4_comment', 'day_1_comment',], 'integer'],

                [['title', 'url', 'tag_list'], 'string', 'max' => 255],

                ['members_count_like', 'integer', 'min' => Service::findOne(['model_name' => 'LikeVK'])->minimum_tasks],
                ['members_count_repost', 'integer',
                    'min' => Service::findOne(['model_name' => 'RepostVK'])->minimum_tasks],
                ['members_count_comment', 'integer',
                    'min' => Service::findOne(['model_name' => 'CommentVK'])->minimum_tasks],

                ['isNewRecord', 'safe'],

                //                                [['title', 'url', 'members_count_like', 'cost_like', 'members_count_repost',
                //                                  'cost_repost', 'members_count_comment', 'cost_comment', 'tag_list',
                //                                  'sex', 'age_min', 'age_max', 'friends_count',
                //                                  'country', 'city_text', 'city', 'minute_1_like',
                //                                  'minutes_5_like', 'hour_1_like', 'hours_4_like',
                //                                  'day_1_like', 'minute_1_repost', 'minutes_5_repost',
                //                                  'hour_1_repost', 'hours_4_repost', 'day_1_repost', 'minute_1_comment',
                //                                  'minutes_5_comment', 'hour_1_comment', 'hours_4_comment', 'day_1_comment',], ''],
            ];
        }

        public function attributeLabels()
        {
            return [
                'kind'                  => 'kind',
                'title'                 => 'Название',
                'url'                   => 'Ссылка',

                'members_count_like'    => 'Кол-во лайков',
                'cost_like'             => 'Цена',

                'members_count_repost'  => 'Кол-во репостов',
                'cost_repost'           => 'cost_repost',

                'members_count_comment' => 'Кол-во комментариев',
                'cost_comment'          => 'cost_comment',

                'tag_list'              => 'Теги',
                'sex'                   => 'Пол',
                'age_min'               => 'Мин. возраст',
                'age_max'               => 'Макс. возраст',
                'friends_count'         => 'Кол-во друзей',
                'country'               => 'Страна',
                'city_text'             => 'Город',
                'city'                  => 'Город(id)',

                'minute_1_like'         => 'за минуту',
                'minutes_5_like'        => 'за 5 минут',
                'hour_1_like'           => 'за час',
                'hours_4_like'          => 'за 4 часа',
                'day_1_like'            => 'за день',

                'minute_1_repost'       => 'за минуту',
                'minutes_5_repost'      => 'за 5 минут',
                'hour_1_repost'         => 'за час',
                'hours_4_repost'        => 'за 4 часа',
                'day_1_repost'          => 'за день',

                'minute_1_comment'      => 'за минуту',
                'minutes_5_comment'     => 'за 5 минут',
                'hour_1_comment'        => 'за час',
                'hours_4_comment'       => 'за 4 часа',
                'day_1_comment'         => 'за день',
            ];
        }

        public function save()
        {
            if (!$this->validate())
                return false;

            $db = \Yii::$app->db;
            $transaction = $db->beginTransaction();
            try {
                $promotion = null;

                if ($this->isNewRecord)
                    $promotion = new Promotion();
                else
                    $promotion = Promotion::findOne(['id' => $this->id]);

                $promotion->user_id = \Yii::$app->user->getId();
                $promotion->url = $this->url;
                $promotion->page_id = VKApi::getGroupIdByUrl($this->url);
                $promotion->status = Promotion::NOT_MODERATED;
                $promotion->save();

                foreach ($promotion->tasks as $task)
                    $task->delete();

                if ($this->hasLikeQuery()) {
                    $likeTask = new Task();
                    $likeTask->service_id = Service::LIKE_VK;
                    $likeTask->promotion_id = $promotion->id;
                    $likeTask->task = json_encode($this->getLikeQuery());
                    $likeTask->save();
                }

                if ($this->hasRepostQuery()) {
                    $likeTask = new Task();
                    $likeTask->service_id = Service::REPOST_VK;
                    $likeTask->promotion_id = $promotion->id;
                    $likeTask->task = json_encode($this->getRepostQuery());
                    $likeTask->save();
                }

                if ($this->hasCommentQuery()) {
                    $likeTask = new Task();
                    $likeTask->service_id = Service::COMMENT_VK;
                    $likeTask->promotion_id = $promotion->id;
                    $likeTask->task = json_encode($this->getCommentQuery());
                    $likeTask->save();
                }

                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();

                return false;
            }

            return true;
        }

        protected
        function hasLikeQuery()
        {
            return $this->members_count_like > 0;
        }

        public
        function getLikeQuery()
        {
            $query = [];
            $task = [];
            $task_limit = [];

            $text = $this->title;

            $task['kind'] = Service::LIKE_VK;

            $task['title'] = iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
            $task['url'] = $this->url;

            $task['members_count'] = $this->members_count_like;
            $task['cost'] = $this->cost_like;

            $task['tag_list'] = $this->tag_list;
            $task['sex'] = $this->sex;
            $task['age_min'] = $this->age_min;
            $task['age_max'] = $this->age_max;
            $task['friends_count'] = $this->friends_count;
            $task['country'] = $this->country;
            $task['city_text'] = $this->city_text;
            $task['city'] = $this->city;

            $task_limit['minute_1'] = $this->minute_1_like;
            $task_limit['minutes_5'] = $this->minutes_5_like;
            $task_limit['hour_1'] = $this->hour_1_like;
            $task_limit['hours_4'] = $this->hours_4_like;
            $task_limit['day_1'] = $this->day_1_like;

            $query['task_limit'] = $task_limit;

            $query['task'] = $task;

            return $query;
        }

        protected
        function hasRepostQuery()
        {
            return $this->members_count_repost > 0;
        }

        public
        function getRepostQuery()
        {
            $query = [];
            $task = [];
            $task_limit = [];

            $text = $this->title;

            $task['kind'] = Service::REPOST_VK;

            $task['title'] = iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
            $task['url'] = $this->url;

            $task['members_count'] = $this->members_count_repost;
            $task['cost'] = $this->cost_repost;

            $task['tag_list'] = $this->tag_list;
            $task['sex'] = $this->sex;
            $task['age_min'] = $this->age_min;
            $task['age_max'] = $this->age_max;
            $task['friends_count'] = $this->friends_count;
            $task['country'] = $this->country;
            $task['city_text'] = $this->city_text;
            $task['city'] = $this->city;

            $task_limit['minute_1'] = $this->minute_1_repost;
            $task_limit['minutes_5'] = $this->minutes_5_repost;
            $task_limit['hour_1'] = $this->hour_1_repost;
            $task_limit['hours_4'] = $this->hours_4_repost;
            $task_limit['day_1'] = $this->day_1_repost;

            $query['task_limit'] = $task_limit;

            $query['task'] = $task;

            return $query;
        }

        protected
        function hasCommentQuery()
        {
            return $this->members_count_comment > 0;
        }

        public
        function getCommentQuery()
        {
            $query = [];
            $task = [];
            $task_limit = [];

            $text = $this->title;

            $task['kind'] = Service::COMMENT_VK;

            $task['title'] = iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
            $task['url'] = $this->url;

            $task['members_count'] = $this->members_count_comment;
            $task['cost'] = $this->cost_comment;

            $task['tag_list'] = $this->tag_list;
            $task['sex'] = $this->sex;
            $task['age_min'] = $this->age_min;
            $task['age_max'] = $this->age_max;
            $task['friends_count'] = $this->friends_count;
            $task['country'] = $this->country;
            $task['city_text'] = $this->city_text;
            $task['city'] = $this->city;

            $task_limit['minute_1'] = $this->minute_1_comment;
            $task_limit['minutes_5'] = $this->minutes_5_comment;
            $task_limit['hour_1'] = $this->hour_1_comment;
            $task_limit['hours_4'] = $this->hours_4_comment;
            $task_limit['day_1'] = $this->day_1_comment;

            $query['task_limit'] = $task_limit;

            $query['task'] = $task;

            return $query;
        }
    }