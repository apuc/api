<?php
    namespace frontend\modules\task\widgets;


    use common\models\db\OrderSynchronize;
    use frontend\modules\task\models\db\Order;
    use frontend\modules\task\models\db\Service;
    use yii\base\Widget;

    class LastTasks extends Widget
    {
        public $type;
        public $kind;

        public function init()
        {
            parent::init();

            $this->type;

            $services = Service::getDb()->cache(function () {
                return Service::find()->all();
            }, 60 * 60 * 24 * 7);

            foreach ($services as $service) {
                if ($this->type == $service->model_name)
                    $this->kind = $service->id;
            }
        }

        public function run()
        {
            $cache = \Yii::$app->cache;

            if (!$cache->exists('synchronize')) {
                OrderSynchronize::synchronizeStatuses();
                $updateStatusesCacheTime = \Yii::$app->params['updateStatusesCacheTime'];
                $cache->set('synchronize', $updateStatusesCacheTime);
            }

            $userId = \Yii::$app->user->getId();

            $orders = Order::find()
                ->where(['user_id' => $userId])
                ->andWhere(['kind' => $this->kind])
                ->orderBy('id DESC')
                ->limit(4)
                ->all();


            if (count($orders))
                return $this->render('lastTasks', ['orders' => $orders]);
            else
                echo '';
        }
    }