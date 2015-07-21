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
use yii\helpers\Url;

class Email
{
    /**
     * @param $model
     * @return bool
     */
    public static function sendActivateMail($model)
    {
        $mailMsg = new EmailMsg();
        $tpl = $mailMsg::findOne(['key' => 'reg']);

        $keyRepl = "{activate_link}";
        $link = Email::genActivateLink($model);
        $msg = preg_replace("/$keyRepl/", $link, $tpl->text);

       /* echo "<br><br><br><br>";
        Debag::prn($msg);*/
        return mail($model->email, 'Активация аккаунта', $msg, "Content-type: text/html; charset=UTF-8\r\n");
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
        $email = $data['email'];
        $id = $data['feedback-id'];
        $id = $data['feedback-id'];
        $id = $data['feedback-id'];

        return mail($data['email'], 'Ответ отсюда', $data['response']);
    }

    public static function  genActivateLink($model)
    {
        return "<a href='".Url::base(true)."/login/reg/activate/?key=".$model->salt."'>Активировать</a>";
    }

}