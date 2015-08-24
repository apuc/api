<?php

    namespace frontend\modules\task\controllers;

    use backend\modules\api\classes\Api;
    use common\classes\Email;
    use common\models\db\User;
    use frontend\modules\task\models\db\Order;
    use Yii;
    use yii\base\ErrorException;
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
                            'actions' => ['view-page', 'view-all', 'repeat', 'update'],
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

        public function actionUpdate($type, $id)
        {
            $order = Order::findOne($id);

            if ($order->user_id != Yii::$app->user->getId())
                throw new ErrorException('Попытка изменить чужое задание');

            if ($order->status != Order::REJECTED)
                throw new ErrorException('Данную задачу редактировать запрещено');

            $order->status = Order::NOT_MODERATED;

            if ($order->load(\Yii::$app->request->post())) {
                if ($order->validate()) {
                    if ($order->addTask()) {
                        Yii::$app->session->setFlash('message', ['type'    => 'success',
                                                                 'message' => 'Задание принято к модерации повторно']);
                        Email::sendNewTaskNotice($order);

                        return $this->redirect(Yii::$app->urlManager->createUrl('task/order/view-all'));
                    }
                } else {
                    Yii::$app->session->setFlash('message', ['type'    => 'danger',
                                                             'message' => 'Пожалуйста, повторите ввод']);
                }
            }

            return $this->render('view', ['type' => $type, 'model' => $order]);
        }

        /**
         * @var User $user
         *
         * @param $id
         * @return string
         * @throws ErrorException
         */
        public function actionRepeat($id)
        {
            $user = Yii::$app->user->identity;

            $order = Order::findOne($id);

            $db = Yii::$app->db;
            if ($order->user_id === $user->getId()) {
                if ($user->money >= $order->sum) {
                    $user->debitMoney($order->sum);

                    $transaction = $db->beginTransaction();
                    try {
                        $user->save();

                        $id = Api::setTaskByNetwork($order);

                        if ($id !== NULL) {
                            $order->status = Order::PROCESSED;
                            $order->foreign_id = $id;
                            $order->save(false);

                            $transaction->commit();

                            Yii::$app->session->setFlash('message', [
                                    'type'    => 'success',
                                    'message' => 'Задание отправлено на повторное выполнение',
                                ]
                            );
                        } else
                            throw new ErrorException();

                    } catch (ErrorException $e) {
                        $transaction->rollBack();
                    }
                }
            } else
                throw new ErrorException('Что-то не так');

            return $this->redirect(Yii::$app->urlManager->createUrl('task/order/view-all'));
        }
    }