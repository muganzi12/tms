<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class NewAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web/flowdash';
    public $css = [
        "assets/vendor/perfect-scrollbar.css",
        "assets/css/app.css",
        "assets/css/vendor-material-icons.css",
        "assets/css/vendor-fontawesome-free.css"
    ];
    public $js = [
        //"assets/vendor/jquery.min.js",
        //"assets/vendor/popper.min.js",
        //"assets/vendor/bootstrap.min.js",
        "assets/vendor/perfect-scrollbar.min.js",
        "assets/vendor/dom-factory.js",
        "assets/vendor/material-design-kit.js",
        "assets/js/toggle-check-all.js",
        "assets/js/check-selected-row.js",
        "assets/js/dropdown.js",
        "assets/js/sidebar-mini.js",
        "assets/js/app.js",
        "assets/js/app-settings.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
