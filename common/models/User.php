<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $money
 * @property string $cash_id
 * @property string $email
 * @property string $password
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $salt
 * @property integer $status
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['money', 'cash_id', 'email', 'password', 'created_at', 'updated_at', 'salt', 'status'], 'required'],
            [['money', 'created_at', 'updated_at', 'status'], 'integer'],
            [['cash_id', 'email', 'password', 'salt'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'money' => 'Money',
            'cash_id' => 'Cash ID',
            'email' => 'Email',
            'password' => 'Password',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'salt' => 'Salt',
            'status' => 'Status',
        ];
    }
}
