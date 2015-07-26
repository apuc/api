<?php

    namespace frontend\modules\interkassa\widgets;


    use yii\base\Widget;

    class AddFunds extends Widget
    {
        public function run()
        {
            $cash = \Yii::$app->user->identity->cash_id;

            return $this->render('form', ['cash_id' => $cash]);
        }
    }