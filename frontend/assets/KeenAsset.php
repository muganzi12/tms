<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class KeenAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web/html-assets/keen/';
    public $css = [
        "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700",
        "css/site.css",
        "plugins/global/plugins.bundle.v2.0.3.css",
        "plugins/custom/prismjs/prismjs.bundle.v2.0.3.css",
        "css/style.bundle.v2.0.3.css",
        "css/themes/layout/header/base/light.css",
        "css/themes/layout/header/menu/light.css",
        "css/themes/layout/brand/dark.css",
        "css/themes/layout/aside/light.css"
    ];
    public $js = [
        "plugins/global/plugins.bundle.v2.0.3.js",
        "plugins/custom/prismjs/prismjs.bundle.v2.0.3.js",
        "js/scripts.bundle.v2.0.3.js",
        //"js/pages/widgets.v2.0.3.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
