<?php

    namespace common\models\db;

    use Yii;

    /**
     * This is the model class for table "feedback".
     *
     * @property integer $id
     * @property string $email
     * @property string $name
     * @property string $text
     * @property string $status
     * @property integer $created_at
     * @property integer $updated_at
     */
    class Feedback extends \yii\db\ActiveRecord
    {
        public $response;

        const PROCESSED = 1;
        const UNPROCESSED = 0;

        public static function getStatusList()
        {
            return [
                self::PROCESSED   => 'Обработано',
                self::UNPROCESSED => 'Не обработано',
            ];
        }

        public function getStatus()
        {
            if ($this->status)
                return 'Обработано';

            return 'Не обработано';
        }

        /**
         * @inheritdoc
         */
        public static function tableName()
        {
            return 'feedback';
        }

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['email', 'name', 'text'], 'required'],
                [['text'], 'string'],
                [['created_at', 'updated_at'], 'integer'],
                [['email'], 'string', 'max' => 255],
                [['name'], 'string', 'max' => 25],
                ['response', 'safe']
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id'         => 'ID',
                'email'      => 'Email',
                'name'       => 'ФИО',
                'text'       => 'Сообщение',
                'status'     => 'Статус',
                'created_at' => 'Дата сообщения',
                'updated_at' => 'Updated At',
                'response'   => 'Ответ',
            ];
        }
    }
