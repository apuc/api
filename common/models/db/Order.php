<?php

    namespace common\models\db;

    use common\models\User;
    use Yii;

    /**
     * This is the model class for table "order".
     *
     * @property integer $id
     * @property integer $user_id
     * @property integer $service_id
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
    class Order extends \yii\db\ActiveRecord
    {
        /**
         * @inheritdoc
         */
        public static function tableName()
        {
            return 'order';
        }

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['user_id', 'service_id', 'date', 'status', 'kind', 'title', 'url', 'members_count', 'cost', 'sum'],
                 'required'],
                [['user_id', 'service_id', 'date', 'status', 'kind', 'members_count', 'cost', 'sex', 'age_min',
                  'age_max', 'friends_count', 'country', 'city', 'minute_1', 'minutes_5', 'hour_1', 'hours_4', 'day_1'],
                 'integer'],
                [['title', 'tag_list'], 'string', 'max' => 250],
                [['url', 'city_text'], 'string', 'max' => 255],
                ['sum', 'double'],

                ['members_count', 'integer', 'min' => $this->service->minimum_tasks],
                ['sum', 'double', 'min' => $this->service->minimum_price_per_task],
                //todo строка ниже возможно не робит, пока нет пользователя проверить трудно
                ['sum', 'double', 'max' => Yii::$app->user->identity->money],

            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id'            => 'ID',
                'user_id'       => 'User ID',
                'service_id'    => 'Service ID',
                'date'          => 'Date',
                'status'        => 'Status',
                'kind'          => 'Kind',
                'title'         => 'Название задания',
                'url'           => 'Ссылка на задание',
                'members_count' => 'Количество выполнений',
                'cost'          => 'Cost',
                'tag_list'      => 'Теги',
                'sex'           => 'Пол',
                'age_min'       => 'Минимальный возраст',
                'age_max'       => 'Максимальнй возраст',
                'friends_count' => 'Минимальное количество друзей',
                'country'       => 'Страна',
                'city_text'     => 'Город',
                'city'          => 'City',
                'minute_1'      => 'Кол-во выполнений за 1 минуту',
                'minutes_5'     => 'Кол-во выполнений за 5 минут',
                'hour_1'        => 'Кол-во выполнений за 1 час',
                'hours_4'       => 'Кол-во выполнений за 4 часа',
                'day_1'         => 'Кол-во выполнений за 1 сутки',
                'sum'           => 'Сумма'
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

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getService()
        {
            return $this->hasOne(Service::className(), ['id' => 'service_id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getUser()
        {
            return $this->hasOne(User::className(), ['id' => 'user_id']);
        }
    }
