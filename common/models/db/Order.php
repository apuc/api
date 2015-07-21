<?php

    namespace common\models\db;

    use common\models\User;
    use Yii;
    use yii\db\ActiveRecord;

    /**
     * This is the model class for table "order".
     *
     * @property integer $id
     * @property integer $user_id
     * @property integer $service_id
     * @property integer $date
     * @property integer $quantity
     * @property integer $status
     * @property string $task
     * @property string $limit
     * @property string $task_url
     *
     * @property Service $service
     * @property User $user
     */
    class Order extends ActiveRecord
    {
        const NOT_MODERATED = 0;
        const MODERATED = 1;
        const PERFORMED = 2;
        const DONE = 3;

        public static function tableName()
        {
            return 'order';
        }

        public function rules()
        {
            return [
                [['user_id', 'service_id', 'date', 'quantity', 'status', 'task'], 'required'],
                [['user_id', 'service_id', 'date', 'quantity', 'status'], 'integer'],
                [['task', 'limit'], 'string']
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id'         => 'ID',
                'user_id'    => 'Пользователь',
                'service_id' => 'Тип задания',
                'date'       => 'Дата',
                'task_url'   => 'Ссылка',
                'quantity'   => 'Заказано',
                'status'     => 'Статус',
                'task'       => 'Задание',
                'limit'      => 'Ограничения',
            ];
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
