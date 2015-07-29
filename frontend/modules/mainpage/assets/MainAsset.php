<?php

    namespace frontend\modules\mainpage\assets;

    use Yii;
    use yii\web\AssetBundle;

    class MainAsset extends AssetBundle
    {
        public $sourcePath = '@mainAssets';
        public $baseUrl = '@web';

        public $js = [
            'js/modal.js',
        ];
        public $css = [
            'css/modal.css'
        ];
    }