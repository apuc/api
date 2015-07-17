<?php
    /**
     * Created by PhpStorm.
     * User: Кирилл
     * Date: 17.07.2015
     * Time: 16:12
     */

    namespace common\classes;

    use Yii;
    use common\models\EmailMsg;
    use common\classes\Debag;

    class Email
    {

        public static function sendActivateMail($model)
        {
            $mailMsg = new EmailMsg();
            $tpl = $mailMsg::findOne(['key' => 'reg']);

            /*echo "<br><br><br><br>";
            Debag::prn($model->email);*/
        }

        /**
         * @param $data array
         * @return bool
         */
        public static function sendFeedbackMail($data)
        {
            if ($data === false)
                return false;

            $data['id'];
            $text = $data['text'];
            $email= $data['email'];
            $id = $data['feedback-id'];
            $id = $data['feedback-id'];
            $id = $data['feedback-id'];

            return mail($data['email'], 'Ответ отсюда', $data['response']);
        }

    }