<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
            'modelClass' => 'Payroll',
        ]) . $model->nip;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Payroll'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nik, 'url' => ['view', 'id' => $model->id_pegawai]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">people</i>
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
