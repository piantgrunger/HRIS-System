<?php

use yii\helpers\Html;
use hscstudio\mimin\components\Mimin;
use yii\helpers\Url;

$this->registerCSSFile(Yii::$app->homeUrl.'css/metro-all.css');
$this->registerCSSFile(Yii::$app->homeUrl.'css/start.css');
$this->registerJSFile(Yii::$app->homeUrl.'js/metro.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJSFile(Yii::$app->homeUrl.'js/start.js', ['depends' => [yii\web\JqueryAsset::className()]]);
/* @var $this yii\web\View */
/* @var $this yii\web\View */

?>



    <div class="container-fluid start-screen no-scroll-y h-100">

<div class="tiles-grid tiles-group  size-3" id="master">



        <?= (Mimin::checkRoute('unit-kerja/index')) ? Html::a("
        <span class='fa fa-building-o icon'></span>
        <span class='branding-bar'>Satuan Kerja</span>
         ", ['/satuan-kerja'], ['data-role' => 'tile', 'class ' => 'bg-green', 'data-effect' => 'animate-slide-up']) : ''; ?>

            <?= (Mimin::checkRoute('satuan-kerja/index')) ? Html::a("
        <span class='mif-location-city icon'></span>
        <span class='branding-bar'>Unit Kerja</span>
         ", ['/unit-kerja'], ['data-role' => 'tile', 'class ' => 'bg-brown', 'data-effect' => 'animate-slide-up']) : ''; ?>


  <?= (Mimin::checkRoute('golongan/index')) ? Html::a("
        <span class='mif-flow-tree icon'></span>
        <span class='branding-bar'>Golongan</span>
         ", ['/golongan'], ['data-role' => 'tile', 'class ' => 'bg-pink', 'data-effect' => 'animate-slide-up']) : ''; ?>



        <?= (Mimin::checkRoute('eselon/index')) ? Html::a("
        <span class='fa fa-star icon'></span>
        <span class='branding-bar'>Eselon</span>
         ", ['/eselon'], ['data-role' => 'tile', 'class ' => 'bg-pink', 'data-effect' => 'animate-slide-up']) : ''; ?>

           <?= (Mimin::checkRoute('jabatan-fungsional/index')) ? Html::a("
        <span class='fa fa-id-badge icon'></span>
        <span class='branding-bar'>Jabatan</span>
         ", ['/jabatan-fungsional'], ['data-role' => 'tile', 'class ' => 'bg-cyan', 'data-effect' => 'animate-slide-up']) : ''; ?>

         <?= (Mimin::checkRoute('pegawai/index')) ? Html::a("
        <span class='mif-users icon'></span>
        <span class='branding-bar'>Pegawai</span>
         ", ['/pegawai'], ['data-role' => 'tile', 'class ' => 'bg-grey', 'data-effect' => 'animate-slide-up']) : ''; ?>

 <?= (Mimin::checkRoute('pegawai/non-pns')) ? Html::a("
        <span class='fa fa-users icon'></span>
        <span class='branding-bar'>Pegawai Non PNS</span>
         ", ['/pegawai/non-pns'], ['data-role' => 'tile', 'class ' => 'bg-green', 'data-effect' => 'animate-slide-up']) : ''; ?>


           <?= (Mimin::checkRoute('shift/index')) ? Html::a("
        <span class='fa fa-clock-o icon'></span>
        <span class='branding-bar'>Shift</span>
         ", ['/shift'], ['data-role' => 'tile', 'class ' => 'bg-blue', 'data-effect' => 'animate-slide-up']) : ''; ?>


           <?= (Mimin::checkRoute('hari-libur/index')) ? Html::a("
        <span class='fa fa-calendar icon'></span>
        <span class='branding-bar'>Hari Libur</span>
         ", ['/hari-libur'], ['data-role' => 'tile', 'class ' => 'bg-red', 'data-effect' => 'animate-slide-up']) : ''; ?>


           <?= (Mimin::checkRoute('jenis-absen/index')) ? Html::a("
        <span class='fa fa-id-card icon'></span>
        <span class='branding-bar'>Jenis Absen</span>
         ", ['/jenis-absen'], ['data-role' => 'tile', 'class ' => 'bg-green', 'data-effect' => 'animate-slide-up']) : ''; ?>


</div>

<div class="tiles-grid tiles-group  size-2" id="proses">




        <?= (Mimin::checkRoute('absen/index')) ? Html::a("
        <span class='fa fa-calendar-check-o icon'></span>
        <span class='branding-bar'>Absen</span>
         ", ['/absen'], ['data-size' =>  'wide',  'data-role' => 'tile', 'class ' => 'bg-pink', 'data-effect' => 'animate-slide-up']) : ''; ?>


        <?= (Mimin::checkRoute('hitung-tunjangan/index')) ? Html::a("
        <span class='fa fa-money icon'></span>
        <span class='branding-bar'>Hitung Tunjangan</span>
         ", ['/hitung-tunjangan'], ['data-size' => 'wide',  'data-role' => 'tile', 'class ' => 'bg-green', 'data-effect' => 'animate-slide-up']) : ''; ?>

</div>
</div>
