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
            'taskAssets'       => Yii::getAlias('@frontend') . '/modules/task/assets',
            'interkassaAssets' => Yii::getAlias('@frontend') . '/modules/interkassa/assets',
            'mainAssets'       => Yii::getAlias('@frontend') . '/modules/mainpage/assets',
            'statisticsAssets' => Yii::getAlias('@common') . '/modules/statistics/assets',
            'promotionAssets'  => Yii::getAlias('@frontend') . '/modules/promotion/assets',
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
            'interkassa' => [
                'class' => 'frontend\modules\interkassa\Interkassa',
            ],
            'news'       => [
                'class' => 'frontend\modules\news\News',
            ],
            'promotion'  => [
                'class' => 'frontend\modules\promotion\Promotion',
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
                    'loginto'             => 'login/login/view',
                    'logout'              => 'login/login/logout',
                    'registration'        => 'login/reg',
                    'profile'             => 'profile/profile',
                    'profile/edit'        => 'profile/profile/edit',
                    'forgot'              => 'login/reg/forgot',
                    'addphoto'            => 'profile/profile/addphoto',
                    ''                    => 'mainpage/mainpage/',
                    'feedback'            => 'feedback/feedback',
                    'order'               => 'task/order/view-page',
                    'order/all'           => 'task/order/view-all',
                    'interkassa/<action>' => 'interkassa/interkassa/<action>',
                    'autopromotion'       => 'promotion/promotion/view-promotion',
                    'autopromotion/list'  => 'promotion/promotion/view-all',
                ],
            ],
            'user'         => [
                'identityClass'   => 'common\models\db\User',
                'enableAutoLogin' => true,
                'loginUrl'        => 'loginto',
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