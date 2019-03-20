<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SatuanKerja */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="satuan-kerja-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nama_satuan_kerja') ?></label>
        <div class="col-md-6">

    <?= $form->field($model, 'nama_satuan_kerja')->textInput(['maxlength' => true])
        ->label(false); ?>
        </div>
    </div>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('checklog_key') ?></label>
        <div class="col-md-6">

    <?= $form->field($model, 'checklog_key')->textInput(['maxlength' => true])
        ->label(false); ?>
        </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tanggal_absen_terakhir') ?></label>
        <div class="col-md-6">

    <?= $form->field($model, 'tanggal_absen_terakhir')->textInput(['maxlength' => true])
        ->label(false); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
