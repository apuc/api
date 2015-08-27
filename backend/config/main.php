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
            'feedbackAssets'      => Yii::getAlias('@backend') . '/modules/feedback/assets',
            'serviceAssets'       => Yii::getAlias('@backend') . '/modules/service/assets',
            'taskAssets'          => Yii::getAlias('@backend') . '/modules/task/assets',
            'autopromotionAssets' => Yii::getAlias('@backend') . '/modules/autopromotion/assets',
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
            'news'      => [
                'class' => 'backend\modules\news\News',
            ],
            'user'      => [
                'class' => 'backend\modules\user\User',
            ],
            'autopromotion' => [
                'class' => 'backend\modules\autopromotion\AutoPromotion',
            ],
            'settings' => [
                'class' => 'backend\modules\settings\Settings',
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
                    'login'    => 'login/login/view',
                    ''         => 'adminpage/admin/view',
                    'logout'   => 'login/login/logout',
                    'email'    => 'email/email',
                    'feedback' => 'feedback/feedback',
                    'service'  => 'service/service',
                    'user'     => 'user/user',
                ],
            ],
            'user'         => [
                'identityClass'   => 'common\models\db\User',
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
