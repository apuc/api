<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "wrap".
 *
 * @property integer $id
 * @property integer $done_wrap_vk
 * @property integer $like_wrap_vk
 * @property integer $repost_wrap_vk
 * @property integer $subscriber_wrap_vk
 */
class Wrap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wrap';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['done_wrap_vk', 'like_wrap_vk', 'repost_wrap_vk', 'subscriber_wrap_vk'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'done_wrap_vk' => 'Done Wrap Vk',
            'like_wrap_vk' => 'Like Wrap Vk',
            'repost_wrap_vk' => 'Repost Wrap Vk',
            'subscriber_wrap_vk' => 'Subscriber Wrap Vk',
        ];
    }
}
