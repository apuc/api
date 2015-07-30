<?php

    namespace frontend\modules\login\models\forms;

    use Yii;
    use yii\base\Model;
    use yii\db\ActiveRecord;

    /**
     * @property integer $id
     * @property string $email
     * @property string $password
     * @property string $username
     */
    class RegForm extends Model
    {
        public $username;
        public $password;
        public $email;

        public function rules()
        {
            return [
                // username and password are both required
                [['username', 'password', 'email'], 'required'],
                ['email', 'email'],
                // rememberMe must be a boolean value

            ];
        }

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