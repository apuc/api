<?php
    /**
     * Created by PhpStorm.
     * User: Кирилл
     * Date: 17.07.2015
     * Time: 16:12
     */

    namespace common\classes;

    use frontend\modules\task\models\db\Order;
    use Yii;
    use common\models\db\EmailMsg;
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
            /*$mailMsg = new EmailMsg();
            $tpl = $mailMsg::findOne(['key' => 'reg']);*/

            /*$keyRepl = "{activate_link}";*/
            $link = Additional::genActivateLink($model);
            //$link = Email::genActivateLink($model);
            /*$msg = preg_replace("/$keyRepl/", $link, $tpl->text);*/
            $msg = "Для активации аккаунта перейдите по ссылке $link";

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

            return mail($data['email'], 'Ответ от: ' . $_SERVER['HTTP_HOST'] , $data['response']);
        }

        /**
         * @param $order Order
         * @return bool
         */
        public static function sendNewTaskNotice($order)
        {
            /**
             * отдельная страница с таблицей в которой будет вид задания,
             * ссылка на накручиваемый продукт и две кнопки: принять/отказать
             * + на почту отправление письма о том, что пришло задание,
             * в идеале с теми же данными, что и в таблице,
             * если сложно, то просто уведомление о новом задании. Верстка таблицы и внешний вид значения не имеют.
             */

            $adminEmail = Yii::$app->params['adminEmail'];


            $template =
                "Тип задания: " . $order->service->name . "<br />" .
                "Дата: " . Yii::$app->formatter->asDatetime($order->date) . "<br />" .
                "Статус: " . $order::getStatuses()[$order->status] . "<br />" .
                "Название задания: " . $order->title . "<br />" .
                "Ссылка на задание: " . '<a href="' . $order->url . '" target=_blank>' . $order->url . '</a>' . "<br />" .
                "Сумма, руб: " . $order->sum . "<br /><br />" .
                "<a href=" . Yii::$app->urlManager->createAbsoluteUrl('secure/task/order/index') . ">В раздел модерации</a>";

            return mail($adminEmail, 'Уведомление о новом заказе', $template);
        }

        public static function sendForgotPass($email, $pass)
        {
            return mail($email, 'Восстановление пароля', 'Ваш новый пароль: ' . $pass);
        }

        public static function sendFeedBackToUser($model)
        {
            $mailMsg = new EmailMsg();
            $tpl = $mailMsg::findOne(['key' => 'feedback_to_user']);
            return mail($model->email, $tpl->title, $tpl->text);
        }

    }