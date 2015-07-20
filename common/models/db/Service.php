<?php

    namespace common\models\db;

    use backend\modules\service\models\db\Like;
    use Yii;
    use yii\db\ActiveRecord;

    /**
     * This is the model class for table "service".
     *
     * @property integer $id
     * @property string $name
     * @property string $model_name
     * @property integer $minimum_all_likes
     * @property integer $minimum_tasks
     * @property integer $minimum_likes_per_task
     * @property double $price_per_like
     * @property double minimum_price_per_task
     */
    class Service extends ActiveRecord
    {
        /**
         * @inheritdoc
         */
        public static function tableName()
        {
            return 'service';
        }

        /**
         * @inheritdoc
         */


        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id'                     => 'ID',
                'model_name'             => 'Имя модели',
                'name'                   => 'Название',
                'minimum_all_likes'      => 'Минимальное кол-во лайков для задания',
                'minimum_tasks'          => 'Кол-во выполнений',
                'minimum_likes_per_task' => 'Лайков за выполнение',
                'price_per_like'         => 'Цена за лайк, руб',
                'minimum_price_per_task' => 'Минимальная цена задания',
            ];
        }
    }
