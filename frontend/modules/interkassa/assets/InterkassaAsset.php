<?php

    namespace frontend\modules\interkassa\assets;

    use Yii;
    use yii\web\AssetBundle;

    class InterkassaAsset extends AssetBundle
    {
        public $sourcePath = '@interkassaAssets';
        public $baseUrl = '@web';

        public $js = [
            'js/modal.js',
        ];
        public $css = [
            'css/modal.css'
        ];
    }