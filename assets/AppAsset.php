<?php

/**
 * @see http://www.yiiframework.com/
 *
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 *
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons',
        'https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css',
        'creative/assets/css/material-dashboard.css?v=2.1.0',
        'creative/assets/demo/demo.css',
        'css/paging.css',

        'css/site.css',

    ];
    public $js = [
        //'creative/assets/js/core/jquery.min.js',
        'creative/assets/js/core/popper.min.js',
        'creative/assets/js/core/bootstrap-material-design.min.js',
        'creative/assets/js/plugins/perfect-scrollbar.jquery.min.js',
        //'creative/assets/js/plugins/moment.min.js',
        //'creative/assets/js/plugins/sweetalert2.js',
        //'creative/assets/js/plugins/jquery.validate.min.js',
        //'creative/assets/js/plugins/jquery.bootstrap-wizard.js',
        //'creative/assets/js/plugins/bootstrap-selectpicker.js',
        //'creative/assets/js/plugins/bootstrap-datetimepicker.min.js',
        //'creative/assets/js/plugins/jquery.dataTables.min.js',
        //'creative/assets/js/plugins/bootstrap-tagsinput.js',
        //'creative/assets/js/plugins/jasny-bootstrap.min.js',
        //'creative/assets/js/plugins/fullcalendar.min.js',
        //'creative/assets/js/plugins/jquery-jvectormap.js',
        //'creative/assets/js/plugins/nouislider.min.js',
        //'https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js',
        //'creative/assets/js/plugins/arrive.min.js',
        //'creative/assets/js/plugins/chartist.min.js',
        //'creative/assets/js/plugins/bootstrap-notify.js',
        'creative/assets/js/material-dashboard.js?v=2.1.0',
        //'creative/assets/demo/demo.js',
        'js/login.main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
