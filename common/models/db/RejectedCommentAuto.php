<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "rejected_comment_auto".
 *
 * @property integer $id
 * @property integer $promotion_id
 * @property string $text
 * @property integer $date
 *
 * @property Promotion $promotion
 */
class RejectedCommentAuto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rejected_comment_auto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['promotion_id'], 'required'],
            [['promotion_id', 'date'], 'integer'],
            [['text'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'promotion_id' => 'Promotion ID',
            'text' => 'Text',
            'date' => 'Date',
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
