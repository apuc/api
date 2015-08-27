<?php

    namespace frontend\modules\login\models\forms;

    use Yii;
    use yii\base\Model;

    /**
     * @property string $email
     * @property string $password
     * @property string $username
     * @property string $parent_referral_link
     */
    class RegForm extends Model
    {
        public $username;
        public $password;
        public $email;
        public $parent_referral_link;

        public function rules()
        {
            return [
                // username and password are both required
                [['username', 'password', 'email'], 'required'],
                ['email', 'email'],
                ['parent_referral_link', 'string']
                // rememberMe must be a boolean value

            ];
        }

        public function attributeLabels()
        {
            return [
                'username'             => 'ФИО',
                'email'                => 'Email',
                'password'             => 'Пароль',
                'parent_referral_link' => 'Реферальный код',
            ];
        }
    }