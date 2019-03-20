<?php

namespace app\assets;

use yii\web\AssetBundle;

class MaterialPluginAsset extends AssetBundle
{
    //public $sourcePath = '@app/widgets/material-dashboard/assets/';
    public $js = [
      //  'datatables/dataTables.bootstrap.min.js',
      //'https://demos.creative-tim.com/material-dashboard/assets/js/material-dashboard.min.js?v=2.1.1',
        // more plugin Js here
        //'js/material.min.js',
       // "js/core/jquery.min.js",
//        "js/core/popper.min.js",

     //   'js/core/bootstrap-material-design.min.js',
  //      "js/plugins/perfect-scrollbar.jquery.min.js",
    //    "js/material-dashboard.min.js?v=2.1.0",
      //  "js/plugins/bootstrap-notify.js",
    ];
    public $css = [
        // more plugin CSS here
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        'http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons',
        'https://fonts.googleapis.com/icon?family=Material+Icons',

        //'css/material-dashboard.css?v=2.1.0 ',
    ];
    public $depends = [
           'rmrevin\yii\fontawesome\AssetBundle',

     'ramosisw\CImaterial\web\MaterialAsset',
    ];
}
