<?php

    namespace backend\modules\feedback\assets;

    use Yii;
    use yii\web\AssetBundle;

    class FeedbackAsset extends AssetBundle
    {
        public $sourcePath = '@feedbackAssets';
        public $baseUrl = '@web';

        public $js = [
            'js/modal.js',
        ];
        public $css = [
            'css/modal.css'
        ];
    }