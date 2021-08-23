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
class MetronicRtlAsset extends AssetBundle {

    public $basePath = '@webroot/themes/metronic';
    public $baseUrl = '@web/themes/metronic';
    public $css = [
        "assets/global/plugins/font-awesome/css/font-awesome.min.css",
        "assets/global/plugins/simple-line-icons/simple-line-icons.min.css",
        "assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css",
        "assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css",
        "assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css",
        "assets/global/plugins/bootstrap-sweetalert/sweetalert.css",
        "assets/global/plugins/morris/morris.css",
        "assets/global/plugins/fullcalendar/fullcalendar.min.css",
        "assets/global/plugins/bootstrap-toastr/toastr-rtl.min.css",
        "assets/global/css/components-md-rtl.min.css",
//        "assets/global/css/plugins-md-rtl.min.css",
//        "assets/pages/css/coming-soon-rtl.min.css",
        "assets/layouts/layout3/css/layout-rtl.min.css",
        "assets/layouts/layout3/css/themes/default-rtl.min.css",
        "assets/layouts/layout3/css/custom-rtl.css",
        "assets/pages/css/error-rtl.min.css",
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
    public $depends = [
        'app\assets\AppRtlAsset'
    ];

}
