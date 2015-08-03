<?php

    namespace common\modules\statistics\assets;

    use Yii;
    use yii\web\AssetBundle;

    class StatisticsAsset extends AssetBundle
    {
        public $sourcePath = '@statisticsAssets';
        public $baseUrl = '@frontend/web';

        public $js = [
            'js/stat.js',
        ];
    }