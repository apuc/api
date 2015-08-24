<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property integer $promotion_id
 * @property string $url
 * @property integer $post_id
 *
 * @property Promotion $promotion
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'promotion_id', 'url'], 'required'],
            [['service_id', 'promotion_id', 'post_id'], 'integer'],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Service ID',
            'promotion_id' => 'Promotion ID',
            'url' => 'Url',
            'post_id' => 'Post ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotion()
    {
        return $this->hasOne(Promotion::className(), ['id' => 'promotion_id']);
    }
}
