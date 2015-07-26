<?php
    /**
     * Created by PhpStorm.
     * User: Кирилл
     * Date: 23.07.2015
     * Time: 16:05
     */

    namespace common\models;


    use yii\base\Model;

    class FeedbackForm extends Model
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