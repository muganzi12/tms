<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LoginAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web/theme/';
    public $css = [
        "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&amp;display=swap",
        // "assets/fontawesome/js/all.min.js",
        "assets/plugins/tiny-slider/tiny-slider.css",
        "https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.2/styles/atom-one-dark.min.css",
        "assets/css/theme.css",
        "assets/fontawesome/css/all.css"
    ];
    public $js = [
        // Javascript        
        "assets/plugins/jquery-3.4.1.min.js",
        "assets/plugins/popper.min.js",
        "assets/plugins/bootstrap/js/bootstrap.min.js",
        // Page Specific JS
        "https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.8/highlight.min.js",
        "assets/js/highlight-custom.js",
        "assets/js/tinyslider-custom.js",
        //Logged in User
        "assets/plugins/jquery.scrollTo.min.js",
        "assets/plugins/lightbox/dist/ekko-lightbox.min.js",
        "assets/js/docs.js",
    ];
    public $depends = [
    ];

}
