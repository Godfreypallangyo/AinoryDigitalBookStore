<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        '/css/bootstrap.min.css',
        '/css/jquery-ui.css',
        '/css/owl.carousel.min.css',
        '/css/owl.theme.default.min.css',
        '/css/owl.theme.default.min.css',
        '/css/jquery.fancybox.min.css',
        '/css/bootstrap-datepicker.css',
        '/fonts/flaticon/font/flaticon.css',
        '/css/aos.css',
        '/css/style.css',
    ];
    public $js = [
        '/js/jquery-3.3.1.min.js',
        '/js/jquery-migrate-3.0.1.min.js',
        '/js/jquery-ui.js',
        '/js/popper.min.js',
        '/js/bootstrap.min.js',
        '/js/owl.carousel.min.js',
        '/js/jquery.stellar.min.js',
        '/js/jquery.countdown.min.js',
        '/js/bootstrap-datepicker.min.js',
        '/js/jquery.easing.1.3.js',
        '/js/aos.js',
        '/js/jquery.fancybox.min.js',
        '/js/jquery.sticky.js',
        'js/main.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
