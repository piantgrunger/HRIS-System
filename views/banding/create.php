<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Banding */

$this->title = Yii::t('app', 'Pembelaan Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Pembelaan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banding-create">
  <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">touch_app</i>
                </div>
                <h4 class="card-title"><?=$this->title?> </h4>
            </div>
            <div class="card-body ">

                <?=
                $this->render('_form', [
                    'model' => $model,
                ]);
                ?>

            </div>
        </div>
    </div>
