<?php

use yii\helpers\Html;
use hscstudio\mimin\components\Mimin;

$this->registerCSSFile(Yii::$app->homeUrl.'css/metro-all.css');
$this->registerCSSFile(Yii::$app->homeUrl.'css/start.css');
$this->registerJSFile(Yii::$app->homeUrl.'js/metro.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJSFile(Yii::$app->homeUrl.'js/start.js', ['depends' => [yii\web\JqueryAsset::className()]]);
/* @var $this yii\web\View */
/* @var $this yii\web\View */

?>



    <div class="container-fluid start-screen no-scroll-y h-100">

<div class="tiles-grid tiles-group  size-3" id="master">


  <?= (Mimin::checkRoute('mimin/route')) ? Html::a("
        <span class='fa fa-gears icon'></span>
        <span class='branding-bar'>Route</span>
         ", ['/mimin/route'], ['data-role' => 'tile', 'class ' => 'bg-indigo']) : ''; ?>
    <?= (Mimin::checkRoute('mimin/role')) ? Html::a("
        <span class='fa fa-users icon'></span>
        <span class='branding-bar'>Role</span>
         ", ['/mimin/role'], ['data-role' => 'tile', 'class ' => 'bg-cyan']) : ''; ?>
    <?= (Mimin::checkRoute('/user')) ? Html::a("
        <span class='fa fa-user-o icon'></span>
        <span class='branding-bar'>User</span>
         ", ['/user'], ['data-role' => 'tile', 'class ' => 'bg-red']) : ''; ?>

</div>

</div>
