<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property integer $id
 * @property integer $cash_id
 * @property double $money
 * @property integer $ik_inv_id
 *
 * @property User $cash
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cash_id'], 'required'],
            [['cash_id', 'ik_inv_id'], 'integer'],
            [['money'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cash_id' => 'Cash ID',
            'money' => 'Money',
            'ik_inv_id' => 'Ik Inv ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCash()
    {
        return $this->hasOne(User::className(), ['id' => 'cash_id']);
    }
}
