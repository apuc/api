<?php

    namespace frontend\modules\task\assets;

    use Yii;
    use yii\web\AssetBundle;

    class TaskAsset extends AssetBundle
    {
        public $sourcePath = '@taskAssets';
        public $baseUrl = '@web';

        public $js = [
            'js/script.js',
        ];
    }