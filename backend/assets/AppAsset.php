<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/html-assets/';
    public $css = [
        'lib/fontawesome-free/css/all.min.css',
        'lib/ionicons/css/ionicons.min.css',
        'lib/typicons.font/typicons.css',
        'lib/morris.js/morris.css',
        'lib/flag-icon-css/css/flag-icon.min.css',
        'lib/jqvmap/jqvmap.min.css',
        'css/azia.css',
        "t1/custom-styles.css"
    ];
    public $js = [
        'lib/bootstrap/js/bootstrap.bundle.min.js',
        'lib/ionicons/ionicons.js',
        'js/azia.js',
        'js/settings.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
