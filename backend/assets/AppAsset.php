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
        'statics/css/bootstrap.min14ed.css',
        'statics/css/font-awesome.min93e3.css',
        'statics/css/animate.min.css',
        'statics/css/style.min862f.css',
    ];
    public $js = [
        'statics/js/bootstrap.min.js',
        'statics/js/plugins/metisMenu/jquery.metisMenu.js',
        'statics/js/plugins/slimscroll/jquery.slimscroll.min.js',
        'statics/js/plugins/layer/layer.min.js',
        'statics/js/hplus.min.js',
        'statics/js/contabs.min.js',
        'statics/js/plugins/pace/pace.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
