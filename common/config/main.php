<?php
    return [
        'language'      => 'ru',
        'vendorPath'    => dirname(dirname(__DIR__)) . '/vendor',
        'modules'       => [
            'statistics' => [
                'class' => 'common\modules\statistics\Statistics',
            ],
        ],
        'components'    => [
            'cache'       => [
                'class' => 'yii\caching\FileCache',
            ],
            'authManager' => [
                'class' => 'yii\rbac\DbManager',
            ],

        ],
        'controllerMap' => [
            'elfinder' => [
                'class'            => 'mihaildev\elfinder\Controller',
                'access'           => ['@', '?'],
                //глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем ['@', '?']
                'disabledCommands' => ['netmount'],
                //отключение ненужных команд https://github.com/Studio-42/elFinder/wiki/Client-con..
                'roots'            => [
                    [
                        'baseUrl'  => '',
                        'basePath' => '@frontend/web',
                        'path'     => 'image/upload',
                        'name'     => 'Изображения',
                    ],
                ],
                'watermark'        => [
                    'source'         => __DIR__ . '/logo.png', // Path to Water mark image
                    'marginRight'    => 5, // Margin right pixel
                    'marginBottom'   => 5, // Margin bottom pixel
                    'quality'        => 95, // JPEG image save quality
                    'transparency'   => 70, // Water mark image transparency ( other than PNG )
                    'targetType'     => IMG_GIF | IMG_JPG | IMG_PNG | IMG_WBMP, // Target image formats ( bit-field )
                    'targetMinPixel' => 200 // Target image minimum pixel size
                ]
            ]
        ],
    ];
