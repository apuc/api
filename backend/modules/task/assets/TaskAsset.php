<?php

    namespace backend\modules\task\assets;

    use Yii;
    use yii\web\AssetBundle;

    class TaskAsset extends AssetBundle
    {
        public $sourcePath = '@taskAssets';
        public $baseUrl = '@web';

        public $js = [
            'js/modal.js',
        ];
        public $css = [
            'css/modal.css'
        ];
    }