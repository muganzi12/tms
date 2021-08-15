<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LayoutAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web/template/';
    public $css = [
        "https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap",
        "vendors/styles/core.css",
        "vendors/styles/icon-font.min.css",
        "vendors/styles/style.css",
        'css/custom-style.css',
        'css/custom.css'
    ];
    public $js = [
        'src/scripts/custom-validations.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
