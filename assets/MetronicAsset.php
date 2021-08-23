<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MetronicAsset extends AssetBundle {

    public $basePath = '@webroot/themes/metronic';
    public $baseUrl = '@web/themes/metronic';
    public $css = [
        "assets/global/plugins/font-awesome/css/font-awesome.min.css",
        "assets/global/plugins/simple-line-icons/simple-line-icons.min.css",
        "assets/global/plugins/bootstrap/css/bootstrap.min.css",
        "assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css",
        "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css",
        "assets/global/plugins/bootstrap-sweetalert/sweetalert.css",
        "assets/global/plugins/morris/morris.css",
        "assets/global/plugins/fullcalendar/fullcalendar.min.css",
        "assets/global/plugins/bootstrap-toastr/toastr.min.css",
        "assets/global/css/components-md.min.css",
//        "assets/global/css/plugins-md.min.css",
//        "assets/pages/css/coming-soon.min.css",
        "assets/layouts/layout3/css/layout.min.css",
        "assets/layouts/layout3/css/themes/default.min.css",
        "assets/layouts/layout3/css/custom.css",
        "assets/pages/css/error.min.css",
    ];
    public $js = [
        "assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js",
        "assets/global/plugins/bootstrap-toastr/toastr.min.js",
//        "assets/global/scripts/app.min.js",
        "assets/pages/scripts/ui-toastr.min.js",
        "https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js",
        "https://www.gstatic.com/firebasejs/8.10.0/firebase-analytics.js"
        ,
        "myjs/initiatefirebase.js"
    ];
//    public $jsOptions = [
//        'position' => \yii\web\View::POS_BEGIN
//    ];
    public $depends = [
        'app\assets\AppAsset'
    ];

}
