<?php

    namespace frontend\modules\task\controllers;

    use common\classes\Debag;
    use frontend\modules\task\models\db\Order;
    use Yii;
    use yii\filters\AccessControl;
    use yii\web\Controller;

    class OrderController extends Controller
    {
        public function behaviors()
        {
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['view-page'],
                            'allow'   => true,
                            'roles'   => ['@'],
                        ],
                    ],
                ],
            ];
        }

        public function actionAddTask()
        {
        }

        //todo эмейл оповещение
        public function actionViewPage($type)
        {
            $order = new Order($type);

            if ($order->load(\Yii::$app->request->post()) && $order->validate()) {
                if ($order->addTask())
                    Yii::$app->session->setFlash('done', "Задание принято к модерации");

                return $this->render('view', ['type'  => $type,
                                              'model' => new Order($type)]);
            }

            return $this->render('view', ['type' => $type, 'model' => $order]);
        }
    }