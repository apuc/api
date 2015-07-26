<?php

    namespace common\models;

    use Yii;

    /**
     * This is the model class for table "email_msg".
     *
     * @property integer $id
     * @property string $title
     * @property string $key
     * @property string $text
     */
    class EmailMsg extends \yii\db\ActiveRecord
    {
        /**
         * @inheritdoc
         */
        public static function tableName()
        {
            return 'email_msg';
        }

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['title', 'key', 'text'], 'required'],
                [['text'], 'string'],
                [['title', 'key'], 'string', 'max' => 255]
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id'    => 'ID',
                'title' => 'Заголовок',
                'key'   => 'Ключ (латиница)',
                'text'  => 'Текст письма',
            ];
        }
    }
