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

class Email {

    public static function sendActivateMsg($model){
        $mailMsg = new EmailMsg();
        $tpl = $mailMsg::findOne(['key' => 'reg']);
        /*echo "<br><br><br><br>";
        Debag::prn($model->email);*/
    }

} 