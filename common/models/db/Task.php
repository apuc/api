<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property integer $service_id
 * @property integer $promotion_id
 * @property string $task
 *
 * @property Promotion $promotion
 * @property Service $service
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'promotion_id', 'task'], 'required'],
            [['service_id', 'promotion_id'], 'integer'],
            [['task'], 'string']
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
            'task' => 'Задание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotion()
    {
        return $this->hasOne(Promotion::className(), ['id' => 'promotion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }
}
