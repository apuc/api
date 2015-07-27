<?php
    /**
     * @link http://www.yiiframework.com/
     * @copyright Copyright (c) 2008 Yii Software LLC
     * @license http://www.yiiframework.com/license/
     */

    namespace frontend\assets;

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
            'css/jquery-jvectormap-1.2.2.css',
            'css/AdminLTE.min.css',
            'css/_all-skins.min.css',
        ];
        public $js = [
            'js/bootstrap.min.js',
            'js/fastclick.min.js',
            'js/app.min.js',
            'js/jquery.sparkline.min.js',
            'js/jquery-jvectormap-1.2.2.min.js',
            'js/jquery-jvectormap-world-mill-en.js',
            'js/jquery.slimscroll.min.js',
            'js/Chart.min.js',
            // todo этот файл порит подсказки
            //'js/dashboard2.js',
            'js/demo.js',
        ];
        public $depends = [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
            'frontend\\modules\\task\\assets\\TaskAsset',
            'frontend\\modules\\interkassa\\assets\\InterkassaAsset'
        ];
        public $img = [
            'img/user2-160x160.jpg'
        ];
    }
