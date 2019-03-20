<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Golongan */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Golongan',
]) . $model->kode_golongan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Golongan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_golongan, 'url' => ['view', 'id' => $model->id_golongan]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="golongan-update">

  <div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">list</i>
                </div>
                <h4 class="card-title"><?=$this->title?></h4>
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
</div>
