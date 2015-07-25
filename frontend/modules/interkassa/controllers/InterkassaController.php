<?php

    namespace frontend\modules\interkassa\controllers;


    use common\classes\Debag;
    use yii\filters\AccessControl;
    use yii\filters\VerbFilter;
    use yii\web\Controller;

    class InterkassaController extends Controller
    {
//        public $enableCsrfValidation = false;

        public function behaviors()
        {
            return [
                'verbs' => [
                    'class'   => VerbFilter::className(),
                    'actions' => [
                        'view'         => ['get', 'post'],
                        'success'      => ['post'],
                        'fail'         => ['post'],
                        'pending'      => ['post'],
                        'info73234234' => ['post'],
                        //'delete' => ['post', 'delete'],
                    ],
                ],
            ];
        }

        public function beforeAction($action)
        {
            if ($action->id === 'success' ||
                $action->id === 'fail' ||
                $action->id === 'pending' ||
                $action->id === 'info73234234'
            )
                $this->enableCsrfValidation = false;

            return parent::beforeAction($action);
        }

        public function actionSuccess()
        {
            return $this->render('success');
        }

        public function actionFail()
        {
            return $this->render('fail');
        }

        public function actionPending()
        {
            return $this->render('pending');
        }

        public function actionInfo73234234()
        {
            $information = \Yii::$app->request->post();

            if ($information['ik_inv_st'] == 'success') {
                $payment = $information['ik_pm_no'];

                $money = $information['ik_co_rfn']; // денюжка после всех процентов

            }
        }

        private function checkIP(){
            if (!empty($_SERVER['HTTP_CLIENT_IP'])){
                //check ip from share internet
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                //to check ip is pass from proxy
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }

            return $ip;
        }
    }