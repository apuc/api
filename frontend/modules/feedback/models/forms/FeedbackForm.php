<?php
    namespace frontend\modules\feedback\models\forms;

    use yii\db\ActiveRecord;

    class FeedbackForm extends ActiveRecord
    {
        public $name;
        public $text;
        public $email;

        public static function tableName()
        {
            return 'feedback';
        }

        public function rules()
        {
            return [
                // username and password are both required
                [['name', 'text', 'email'], 'required'],
                // rememberMe must be a boolean value
                ['email', 'email']

            ];
        }
    }