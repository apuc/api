<?php

    namespace frontend\modules\interkassa\widgets;


    use yii\base\Widget;

    class AddFunds extends Widget
    {
        public function run(){
            $cash = md5(\Yii::$app->user->getId());

            return $this->render('form',['cash_id' => $cash]);
        }
    }