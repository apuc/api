<?php
    $params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'),
        require(__DIR__ . '/../../common/config/params-local.php'),
        require(__DIR__ . '/params.php'),
        require(__DIR__ . '/params-local.php')
    );


    return [
        'id'                  => 'app-backend',
        'basePath'            => dirname(__DIR__),
        'controllerNamespace' => 'backend\controllers',
        'bootstrap'           => ['log'],
        'aliases'             => [
            'feedbackAssets' => Yii::getAlias('@backend') . '/modules/feedback/assets',
            'serviceAssets'  => Yii::getAlias('@backend') . '/modules/service/assets',
        ],
        'modules'             => [
            'api'       => [
                'class' => 'backend\modules\api\Api',
            ],
            'email'     => [
                'class' => 'backend\modules\email\Email',
            ],
            'login'     => [
                'class' => 'backend\modules\login\Login',
            ],
            'adminpage' => [
                'class' => 'backend\modules\adminpage\AdminPage',
            ],
            'feedback'  => [
                'class' => 'backend\modules\feedback\Feedback',
            ],
            'service'   => [
                'class' => 'backend\modules\service\Service',
            ],
            'task'      => [
                'class' => 'backend\modules\task\Task',
            ],
        ],
        'components'          => [
            'request'      => [
                'baseUrl' => '/secure',
            ],
            'urlManager'   => [
                'enablePrettyUrl' => true,
                'showScriptName'  => false,
                'rules'           => [
                    'login'  => 'login/login/view',
                    ''       => 'adminpage/admin/view',
                    'logout' => 'login/login/logout',
                ],
            ],
            'user'         => [
                'identityClass'   => 'common\models\User',
                'enableAutoLogin' => true,
                'loginUrl'        => 'login',
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
