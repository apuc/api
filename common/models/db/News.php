<?php

    namespace common\models\db;

    use Yii;

    /**
     * This is the model class for table "news".
     *
     * @property integer $id
     * @property string $title
     * @property integer $dt_add
     * @property string $content
     * @property string $tags
     * @property integer $status
     * @property string $short_text
     */
    class News extends \yii\db\ActiveRecord
    {
        /**
         * @inheritdoc
         */
        public static function tableName()
        {
            return 'news';
        }

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['title', 'content', 'tags','short_text'], 'required'],
                [['dt_add', 'status'], 'integer'],
                [['content'], 'string'],
                [['title', 'tags','short_text'], 'string', 'max' => 255]
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id'      => 'ID',
                'title'   => 'Заголовок',
                'dt_add'  => 'Дата создания',
                'content' => 'Текст новости',
                'tags'    => 'Тэги',
                'status'  => 'Статус',
                'short_text'=> 'Анонс новости'
            ];
        }
    }
