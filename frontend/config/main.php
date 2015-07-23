<?php
    $params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'),
        require(__DIR__ . '/../../common/config/params-local.php'),
        require(__DIR__ . '/params.php'),
        require(__DIR__ . '/params-local.php')
    );

    return [
        'id'                  => 'app-frontend',
        'basePath'            => dirname(__DIR__),
        'bootstrap'           => ['log'],
        'controllerNamespace' => 'frontend\controllers',
        'aliases'             => [
            'taskAssets' => Yii::getAlias('@frontend') . '/modules/task/assets'
        ],

        'modules'             => [
            'login'      => [
                'class' => 'frontend\modules\login\Login',
            ],
            'profile'    => [
                'class' => 'frontend\modules\profile\Profile',
            ],
            'task'       => [
                'class' => 'frontend\modules\task\Task',
            ],
            'mainpage'   => [
                'class' => 'frontend\modules\mainpage\Mainpage',
            ],
            'feedback'   => [
                'class' => 'frontend\modules\feedback\Feedback',
            ],
            'statistics' => [
                'class' => 'frontend\modules\statistics\Statistics',
            ],
        ],
        'components'          => [
            'request'      => [
                'baseUrl' => '',
            ],
            'urlManager'   => [
                'enablePrettyUrl' => true,
                'showScriptName'  => false,
                'rules'           => [
                    'loginto'      => 'login/login/view',
                    'logout'       => 'login/login/logout',
                    'registration' => 'login/reg',
                    'profile'      => 'profile/profile',
                    'profile/edit' => 'profile/profile/edit',
                    'forgot'       => 'login/reg/forgot',
                    'addphoto'     => 'profile/profile/addphoto',
                    ''             => 'mainpage/mainpage/',
                    'feedback'     => 'feedback/feedback',
                ],
            ],
            'user'         => [
                'identityClass'   => 'common\models\User',
                'enableAutoLogin' => true,
            ],
            'log'          => [
                'traceLevel' => YII_DEBUG ? 3 : 0,
                'targets'    => [
                    [
                        'class'  => 'yii\log\FileTarget',
                        'levels' => ['error', 'warning'],
                    ],

                ],

            ],
            'errorHandler' => [
                'errorAction' => 'site/error',
            ],
        ],
        'params'              => $params,
    ];
