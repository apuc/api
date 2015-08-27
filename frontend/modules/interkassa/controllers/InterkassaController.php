<?php

    namespace frontend\modules\interkassa\controllers;


    use common\models\db\ReferralMoney;
    use common\models\db\Settings;
    use frontend\modules\interkassa\models\db\Payment;
    use frontend\modules\interkassa\models\db\User;
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
                        'success'      => ['post'],
                        'fail'         => ['post'],
                        'pending'      => ['post'],
                        'info73234234' => ['post'],
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

            if ($information['ik_inv_st'] == 'success' && $this->checkSign()) {//проверка подписи и проведенности

                $payment = Payment::findOne(['ik_inv_id']);

                if (!isset($payment)) {//что-бы не прислали проведенный платеж еще раз
                    $payment = new Payment();
                    $cash_id = $information['ik_pm_no'];
                    $money = $information['ik_am'];

                    $payment->cash_id;
                    $payment->money = $money;
                    $payment->ik_inv_id = $information['ik_inv_id'];

                    $payment->save();

                    $user = User::findOne(['cash_id' => $cash_id]);
                    $user->money += $money;
                    $user->save();

                    if (isset($user->parent_referral_link)) {
                        $refMoney = ReferralMoney::find()->where(['user_id' => $user->id])->count();

                        $maxPayments = Settings::findOne(['latin_name' => 'referral_pay_num']);

                        if ($refMoney < $maxPayments) {
                            $percent = Settings::findOne(['latin_name' => 'referral_percent'])->value;

                            $ref = new ReferralMoney();

                            $refUser = User::findOne(['my_referral_link' => $user->parent_referral_link]);
                            $ref->user_id = $refUser->id;
                            $ref->referral_percent = ($money / 100) * $percent;
                            $ref->payment_sum = $money;
                            $ref->save();

                            $refUser->addMoney($ref->referral_percent);
                            $refUser->save();
                        }
                    }
                }
            }
        }

        private function checkSign()
        {
            $info = \Yii::$app->request->post();
            $post_sign = $info['ik_sign'];
            unset($info["ik_sign"]);
            ksort($info, SORT_STRING);
            array_push($info, \Yii::$app->params['interkassaSecretKey']);
            $signString = implode(':', $info);
            $sign = base64_encode(md5($signString, true));

            return $sign == $post_sign;
        }
    }