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
            $cache = \Yii::$app->cache;

            if (!$cache->exists('synchronize')) {
                OrderSynchronize::synchronizeStatuses();
                $updateStatusesCacheTime = \Yii::$app->params['updateStatusesCacheTime'];
                $cache->set('synchronize', $updateStatusesCacheTime);
            }

            $userId = \Yii::$app->user->getId();

            $orders = Order::find()->where(['user_id' => $userId])->orderBy('id DESC')->limit(4)->all();


            if (count($orders))
                return $this->render('lastTasks', ['orders' => $orders]);
            else
                echo 'Вы еще не давали заданий.';
        }
    }