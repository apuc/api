<?php

    namespace frontend\modules\task\controllers;

    use common\classes\Email;
    use frontend\modules\task\behaviors\SynchronizeControl;
    use frontend\modules\task\models\db\Order;
    use Yii;
    use yii\data\ActiveDataProvider;
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
                            'actions' => ['view-page', 'view-all'],
                            'allow'   => true,
                            'roles'   => ['@'],
                        ],
                    ],
                ],
            ];
        }

        public function actionViewAll()
        {
            $userId = \Yii::$app->user->getId();

            $provider = new ActiveDataProvider([
                'query'      => Order::find()->where(['user_id' => $userId]),
                'sort'       => ['defaultOrder' => ['id' => SORT_DESC]],
                'pagination' => [
                    'pageSize' => 20,
                ]
            ]);

            return $this->render('index', ['provider' => $provider]);
        }

        public function actionViewPage($type)
        {
            $order = new Order($type);

            if ($order->load(\Yii::$app->request->post())) {
                if ($order->validate()) {
                    if ($order->addTask()) {
                        Yii::$app->session->setFlash('message', ['type'    => 'success',
                                                                 'message' => 'Задание принято к модерации']);
                        Email::sendNewTaskNotice($order);
                        $order = new Order($type);
                    }
                } else {
                    Yii::$app->session->setFlash('message', ['type'    => 'danger',
                                                             'message' => 'Пожалуйста, повторите ввод']);
                }
            }

            return $this->render('view', ['type' => $type, 'model' => $order]);
        }
    }