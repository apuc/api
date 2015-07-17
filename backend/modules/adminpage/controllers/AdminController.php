<?php

    namespace backend\modules\adminpage\controllers;

    use yii\filters\AccessControl;
    use yii\web\Controller;

    class AdminController extends Controller
    {
//        public function behaviors()
//        {
//            return [
//                'access' => [
//                    'class' => AccessControl::className(),
//                    'rules' => [
//                        [
//                            'actions' => ['view', 'error'],
//                            'allow'   => true,
//                            'roles'   => ['administrator', 'moderator'],
//                        ],
//                    ],
//                ],
//            ];
//        }

        public function actionView()
        {
            return $this->render('adminpage');
        }
    }
