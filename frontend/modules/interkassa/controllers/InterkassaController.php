<?php

    namespace frontend\modules\interkassa\controllers;


    use yii\web\Controller;

    class InterkassaController extends Controller
    {
        public function actionView() {
            return $this->render('form');
        }
    }