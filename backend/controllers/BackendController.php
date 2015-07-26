<?php

    namespace backend\controllers;

    use yii\filters\AccessControl;
    use yii\web\Controller;

    class BackendController extends Controller
    {
        public function behaviors()
        {
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['administrator'],
                        ],
                        // everything else is denied
                    ],
                ],
            ];
        }
    }
