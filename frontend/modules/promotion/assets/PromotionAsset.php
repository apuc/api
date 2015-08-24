<?php

    namespace frontend\modules\promotion\assets;

    use Yii;
    use yii\web\AssetBundle;

    class PromotionAsset extends AssetBundle
    {
        public $sourcePath = '@promotionAssets';
        public $baseUrl = '@web';

        public $js = [
            'js/calculate.js',
        ];
    }