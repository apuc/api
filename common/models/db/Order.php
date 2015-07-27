<?php

    namespace common\models\db;

    use Yii;
    use yii\db\ActiveRecord;

    /**
     * This is the model class for table "order".
     *
     * @property integer $id
     * @property integer $user_id
     * @property integer $service_id
     * @property integer $foreign_id
     * @property integer $date
     * @property integer $status
     * @property integer $kind
     * @property string $title
     * @property string $url
     * @property integer $members_count
     * @property integer $cost
     * @property string $tag_list
     * @property integer $sex
     * @property integer $age_min
     * @property integer $age_max
     * @property integer $friends_count
     * @property integer $country
     * @property string $city_text
     * @property integer $city
     * @property integer $minute_1
     * @property integer $minutes_5
     * @property integer $hour_1
     * @property integer $hours_4
     * @property integer $day_1
     * @property double $sum
     *
     * @property Service $service
     * @property User $user
     */
    class Order extends ActiveRecord
    {
        const NOT_MODERATED = 0;
        const PROCESSED = 1;
        const DONE = 2;

        public static function tableName()
        {
            return 'order';
        }

        public function __construct()
        {
            $a = func_get_args();
            $i = func_num_args();
            if (method_exists($this, $f = '__construct' . $i)) {
                call_user_func_array([$this, $f], $a);
            }
        }

        protected function __construct1($kind)
        {
            $this->kind = $this->typeToKind($kind);
            $this->service_id = Service::findOne(['model_name' => $kind])->id;
            $this->user_id = \Yii::$app->user->getId();
            $this->cost = $this->service->minimum_likes_per_task;
            $this->date = time();

            if ($this->isNewRecord)
                $this->status = self::NOT_MODERATED;
        }

        public function rules()
        {
            return [
                [['user_id', 'service_id', 'date', 'status', 'kind', 'title', 'url', 'members_count', 'cost', 'sum'],
                 'required'],
                [['user_id', 'service_id', 'foreign_id', 'date', 'status', 'kind', 'members_count', 'cost', 'sex',
                  'age_min',
                  'age_max', 'friends_count', 'country', 'city', 'minute_1', 'minutes_5', 'hour_1', 'hours_4', 'day_1'],
                 'integer'],
                [['title', 'tag_list'], 'string', 'max' => 250],
                [['url', 'city_text'], 'string', 'max' => 255],

                ['members_count', 'integer', 'min' => $this->service->minimum_tasks],
                ['sum', 'double', 'min' => $this->service->minimum_price_per_task],
                ['sum', 'double', 'max' => Yii::$app->user->identity->money],

            ];
        }

        public function attributeLabels()
        {
            return [
                'id'            => 'ID',
                'user_id'       => 'Пользователь',
                'service_id'    => 'Тип задания',
                'foreign_id'    => 'id на внешнем ресурсе',
                'date'          => 'Дата',
                'status'        => 'Статус',
                'kind'          => 'Kind',
                'title'         => 'Название задания',
                'url'           => 'Ссылка на задание',
                'members_count' => 'Количество выполнений',
                'cost'          => 'Cost',
                'tag_list'      => 'Теги',
                'sex'           => 'Пол',
                'age_min'       => 'Минимальный возраст',
                'age_max'       => 'Максимальный возраст',
                'friends_count' => 'Минимальное количество друзей',
                'country'       => 'Страна',
                'city_text'     => 'Город',
                'city'          => 'City',
                'minute_1'      => 'Кол-во выполнений за 1 минуту',
                'minutes_5'     => 'Кол-во выполнений за 5 минут',
                'hour_1'        => 'Кол-во выполнений за 1 час',
                'hours_4'       => 'Кол-во выполнений за 4 часа',
                'day_1'         => 'Кол-во выполнений за 1 сутки',
                'sum'           => 'Сумма, руб'
            ];
        }

        public function typeToKind($type)
        {
            switch ($type) {
                case 'like':
                    return 1;//        1 - лайки
                case 'subscriber':
                    return 2;//        2 - группы
                case 'repost':
                    return 3;//        3 - рассказать друзьям
                case 'friend':
                    return 4;//        4 - друзья
                case 'comment':
                    return 5;//        5 - комментарии
                case 'interview':
                    return 6;//        6 - опросы
            }
        }

        public function getService()
        {
            return $this->hasOne(Service::className(), ['id' => 'service_id']);
        }

        public function getUser()
        {
            return $this->hasOne(User::className(), ['id' => 'user_id']);
        }

        public function addTask()
        {
            $db = Yii::$app->db;

            $user = User::findOne(['id' => $this->user_id]);

            $user->money = $user->money - $this->sum;

            $transaction = $db->beginTransaction();
            try {
                $user->save();
                $this->save();

                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();

                return false;
            }

            return true;
        }

        public static function getStatuses()
        {
            return [
                self::NOT_MODERATED => 'На модерации',
                self::PROCESSED     => 'Выполняется',
                self::DONE          => 'Выполнено',
            ];
        }

        public function getArray()
        {
            $query = [];
            $task = [];
            $task_limit = [];

            $text = $this->title;

            $task['kind'] = $this->kind;
            $task['title'] = iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
            $task['url'] = $this->url;
            $task['members_count'] = $this->members_count;
            $task['cost'] = $this->cost;
            $task['tag_list'] = $this->tag_list;
            $task['sex'] = $this->sex;
            $task['age_min'] = $this->age_min;
            $task['age_max'] = $this->age_max;
            $task['friends_count'] = $this->friends_count;
            $task['country'] = $this->country;
            $task['city_text'] = $this->city_text;
            $task['city'] = $this->city;

            $task_limit['minute_1'] = $this->minute_1;
            $task_limit['minutes_5'] = $this->minutes_5;
            $task_limit['hour_1'] = $this->hour_1;
            $task_limit['hours_4'] = $this->hours_4;
            $task_limit['day_1'] = $this->day_1;

            $query['task_limit'] = $task_limit;

            $query['task'] = $task;

            return $query;
        }
    }
