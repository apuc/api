<?php

    namespace backend\modules\autopromotion\assets;

    use Yii;
    use yii\web\AssetBundle;

    class AutoPromotionAsset extends AssetBundle
    {
        public $sourcePath = '@autopromotionAssets';
        public $baseUrl = '@web';

        public $js = [
            'js/modal.js',
        ];
        public $css = [
            'css/modal.css'
        ];
    }