<?php

    namespace frontend\modules\task\controllers;

    use common\models\db\Service;
    use frontend\modules\task\models\db\Order;
    use Yii;
    use yii\web\Controller;

    class OrderController extends Controller
    {

        public function actionAddTask()
        {
        }

        public function actionViewPage($type)
        {
            $order = new Order();

            if ($order->load(\Yii::$app->request->post()) && $order->save()) {
                Yii::app()->user->setFlash('done',"Задание принято на модерацию");

                $order = new Order();

                return $this->render('view');
            }

            $order->kind = $order->typeToKind($type);
            $order->service_id = Service::findOne(['model_name' => $type])->id;

            return $this->render('view', ['type' => $type, 'model' => $order]);
        }
    }