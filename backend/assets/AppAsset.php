<?php
    /**
     * @link http://www.yiiframework.com/
     * @copyright Copyright (c) 2008 Yii Software LLC
     * @license http://www.yiiframework.com/license/
     */

    namespace backend\assets;

    use yii\web\AssetBundle;

    /**
     * @author Qiang Xue <qiang.xue@gmail.com>
     * @since 2.0
     */
    class AppAsset extends AssetBundle
    {
        public $basePath = '@webroot';
        public $baseUrl = '@web';
        public $css = [
            'css/site.css',
            'css/admin.css',
        ];
        public $js = [
        ];
        public $depends = [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
            'backend\\modules\\feedback\\assets\\FeedbackAsset',
            'backend\\modules\\service\\assets\\ServiceAsset',
            'backend\\modules\\task\\assets\\TaskAsset',
            'backend\\modules\\autopromotion\\assets\\AutoPromotionAsset',
        ];
    }