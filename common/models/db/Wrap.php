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
 * @property integer $date
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
            [['done_wrap_vk', 'like_wrap_vk', 'repost_wrap_vk', 'subscriber_wrap_vk', 'date'], 'integer']
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
            'date' => 'Time',
        ];
    }

    public static function addWrap(){
        $wrap = new Wrap();

        $wrap->done_wrap_vk = rand(1, 2);
        $wrap->like_wrap_vk = rand(350, 550);
        $wrap->repost_wrap_vk = rand(25, 35);
        $wrap->subscriber_wrap_vk = rand(250, 500);

        $wrap->date = time();

        $wrap->save();
    }

    public static function getStat(){

        $wrap = new Wrap();

        $wrap->done_wrap_vk = Wrap::find()
            ->where(['>', 'date', mktime(strftime('-1 day', time()))])
            ->sum('done_wrap_vk');
        $wrap->like_wrap_vk = Wrap::find()
            ->where(['>', 'date', mktime(strftime('-1 day', time()))])
            ->sum('like_wrap_vk');
        $wrap->repost_wrap_vk = Wrap::find()
            ->where(['>', 'date', mktime(strftime('-1 day', time()))])
            ->sum('repost_wrap_vk');
        $wrap->subscriber_wrap_vk = Wrap::find()
            ->where(['>', 'date', mktime(strftime('-1 day', time()))])
            ->sum('subscriber_wrap_vk');

        return $wrap;
    }
}
