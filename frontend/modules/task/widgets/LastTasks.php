<?php
    /**
     * Created by PhpStorm.
     * User: admin
     * Date: 22.07.2015
     * Time: 22:32
     */

    namespace frontend\modules\task\widgets;


    use common\classes\Debag;
    use common\models\db\OrderSynchronize;
    use frontend\modules\task\models\db\Order;
    use yii\base\Widget;

    class LastTasks extends Widget
    {
        public function run()
        {
            $synchronize = OrderSynchronize::getObj();
            if ($synchronize->timeLeft(300)) {
                OrderSynchronize::synchronizeStatuses();
                $synchronize->updateTime();
            }

            $userId = \Yii::$app->user->getId();

            $orders = Order::find()->where(['user_id' => $userId])->limit(4)->all();

            if (count($orders))
                return $this->render('lastTasks', ['orders' => $orders]);
            else
                echo 'Вы еще не давали заданий.';
        }
    }