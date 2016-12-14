<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'statics/plugins/font-awesome/css/font-awesome.min.css',
        'statics/plugins/ionicons/css/ionicons.min.css',
        'statics/css/AdminLTE.min.css',
        'statics/css/skins/_all-skins.min.css',
    ];
    public $js = [
        'statics/plugins/slimScroll/jquery.slimscroll.min.js',
        'statics/plugins/fastclick/fastclick.js',
        'statics/js/app.min.js',
        'statics/js/demo.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
