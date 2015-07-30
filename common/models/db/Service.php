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
     * @property double $price_per_one_task
     * @property double $minimum_price_per_task
     * @property integer $network
     */
    class Service extends ActiveRecord
    {
        const VK = 1;
        const INSTAGRAM = 2;
        const TWITTER = 3;
        const ASKFM = 4;

        const LIKE_VK = 1;
        const SUBSCRIBER_VK = 2;
        const REPOST_VK = 3;
        const FRIEND_VK = 4;
        const COMMENT_VK = 5;
        const INTERVIEW_VK = 6;
        const LIKE_INSTAGRAM = 7;
        const SUBSCRIBER_INSTAGRAM = 8;
        const RETWIT_TWITTER = 9;
        const SUBSCRIBER_TWITTER = 10;
        const FAVORITE_TWITTER = 11;
        const LIKE_ASKFM = 12;

        public static function tableName()
        {
            return 'service';
        }

        public function attributeLabels()
        {
            return [
                'id'                     => 'ID',
                'model_name'             => 'Имя сценария',
                'name'                   => 'Название',
                'minimum_all_likes'      => 'Мин. кол-во лайков для задания',
                'minimum_tasks'          => 'Кол-во выполнений',
                'minimum_likes_per_task' => 'Лайков за выполнение',
                'price_per_one_task'     => 'Цена за 1 выполнение, руб',
                'minimum_price_per_task' => 'Мин. цена задания',
                'network'                => 'Сайт',
            ];
        }
    }
