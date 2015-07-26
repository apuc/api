<?php

    namespace common\models;

    use Yii;
    use yii\base\Model;

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
     * @property string $username
     */
    class RegForm extends Model
    {
        public $username;
        public $password;
        public $email;

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
                // username and password are both required
                [['username', 'password', 'email'], 'required'],
                // rememberMe must be a boolean value

            ];
        }


        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id'         => 'ID',
                'money'      => 'Money',
                'cash_id'    => 'Cash ID',
                'email'      => 'Email',
                'password'   => 'Пароль',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'salt'       => 'Salt',
                'status'     => 'Status',
                'username'   => 'Имя',
            ];
        }
    }
