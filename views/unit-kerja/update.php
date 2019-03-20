<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UnitKerja */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Unit Kerja',
]).$model->kode_unit_kerja;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Unit Kerja'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_unit_kerja, 'url' => ['view', 'id' => $model->id_unit_kerja]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="unit-kerja-update">

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">account_balance</i>
                </div>
                <h4 class="card-title"><?= Html::encode($this->title); ?> </h4>
            </div>
            <div class="card-body ">
                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>
            </div>
        </div>
    </div>
</div>
