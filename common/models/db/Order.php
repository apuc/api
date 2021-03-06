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
     * @property integer $min_followers
     * @property integer $min_media
     * @property bool $has_avatar
     *
     * @property Service $service
     * @property User $user
     * @property RejectedComment $rejectedComment
     */
    class Order extends ActiveRecord
    {
        const REJECTED = -2;
        const STOPPED = -1;
        const NOT_MODERATED = 0;
        const PROCESSED = 1;
        const DONE = 2;
        const DONE_AND_HIDE = 3;

        public function __construct()
        {
            $a = func_get_args();
            $i = func_num_args();
            if (method_exists($this, $f = '__construct' . $i)) {
                call_user_func_array([$this, $f], $a);
            }
        }

        public static function tableName()
        {
            return 'order';
        }

        public static function getStatuses()
        {
            return [
                self::REJECTED      => 'Отклонено',
                self::STOPPED       => 'Прекращено',
                self::NOT_MODERATED => 'На модерации',
                self::PROCESSED     => 'Выполняется',
                self::DONE          => 'Выполнено',
                self::DONE_AND_HIDE => 'Выполнено',
            ];
        }

        public function rules()
        {
            return [
                [['date', 'status', 'kind', 'title', 'url', 'members_count', 'cost',
                  'tag_list', 'sex', 'age_min', 'age_max', 'friends_count', 'country', 'city_text',
                  'city', 'minute_1', 'minutes_5', 'hour_1', 'hours_4', 'day_1',
                  'sum', 'min_followers', 'min_media'], 'trim'],

                [['date', 'status', 'kind', 'title', 'url', 'members_count', 'cost',
                  'tag_list', 'sex', 'age_min', 'age_max', 'friends_count', 'country', 'city_text',
                  'city', 'minute_1', 'minutes_5', 'hour_1', 'hours_4', 'day_1',
                  'sum', 'min_followers', 'min_media'], 'default'],

                [['user_id', 'service_id', 'date', 'status', 'kind', 'title', 'url', 'members_count', 'cost', 'sum'],
                 'required'],

                [['user_id', 'service_id', 'foreign_id', 'date', 'status', 'kind', 'members_count', 'cost', 'sex',
                  'age_min',
                  'age_max', 'friends_count', 'country', 'city', 'minute_1', 'minutes_5', 'hour_1', 'hours_4', 'day_1',
                  'min_followers', 'min_media'],
                 'integer'],

                [['title', 'tag_list'], 'string', 'max' => 250],

                [['url', 'city_text'], 'string', 'max' => 255],
                ['has_avatar', 'boolean'],

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
                'title'         => 'Название',
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
                'sum'           => 'Сумма, руб',
                'min_followers' => 'Мин.коли-во подписчиков',
                'min_media'     => 'Мин. кол-во записей',
                'has_avatar'    => 'Наличие аватара',
            ];
        }

        public function getService()
        {
            return $this->hasOne(Service::className(), ['id' => 'service_id']);
        }

        public function getUser()
        {
            return $this->hasOne(User::className(), ['id' => 'user_id']);
        }

        public function getRejectedComment()
        {
            return$this->hasMany(RejectedComment::className(), ['order_id' => 'id']);
        }

        public function addTask()
        {
            $db = Yii::$app->db;

            $user = User::findOne(['id' => $this->user_id]);

            $user->debitMoney($this->sum);

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


        protected function __construct1($type)
        {
            $this->initOrder($type);
        }

        protected function initOrder($type)
        {
            $this->service_id = Service::findOne(['model_name' => $type])->id;
            $this->kind = $this->service_id;

            $this->user_id = \Yii::$app->user->getId();
            $this->cost = $this->service->minimum_likes_per_task;
            $this->date = time();

            if ($this->isNewRecord)
                $this->status = self::NOT_MODERATED;
        }
    }