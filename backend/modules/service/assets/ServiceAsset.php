<?php

    namespace backend\modules\service\assets;

    use Yii;
    use yii\web\AssetBundle;

    class ServiceAsset extends AssetBundle
    {
        public $sourcePath = '@serviceAssets';
        public $baseUrl = '@web';

        public $js = [
            'js/service.js',
        ];
    }