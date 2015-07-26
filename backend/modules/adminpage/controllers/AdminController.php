<?php

    namespace backend\modules\adminpage\controllers;

    use backend\controllers\BackendController;
    use yii\filters\AccessControl;
    use yii\web\Controller;

    class AdminController extends BackendController
    {

        public function actionView()
        {
            return $this->render('adminpage');
        }
    }
