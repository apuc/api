<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "referral_money".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $referral_percent
 * @property integer $payment_sum
 *
 * @property User $user
 */
class ReferralMoney extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'referral_money';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'referral_percent', 'payment_sum'], 'required'],
            [['user_id', 'referral_percent', 'payment_sum'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'referral_percent' => 'Referral Percent',
            'payment_sum' => 'Payment Sum',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
