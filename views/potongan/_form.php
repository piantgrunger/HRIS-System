<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Potongan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="potongan-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model) ?>
    <!-- ADDED HERE -->

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('kode_potongan') ?></label>
        <div class="col-md-6"><?= $form->field($model, 'kode_potongan')->textInput(['maxlength' => true])->label(false) ?></div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nama_potongan') ?></label>
        <div class="col-md-6"><?= $form->field($model, 'nama_potongan')->textInput(['maxlength' => true])->label(false) ?></div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('jenis_potongan') ?></label>
        <div class="col-md-6"><?= $form->field($model, 'jenis_potongan')->widget(Select2::className(), [
                                 "data" => [
                                    "Potongan Tetap" => "Potongan Tetap",
                                    "Potongan Berdasarkan Jenis Absen Tertentu" => "Potongan Berdasarkan Jenis Absen Tertentu",
                                 ]
                              ])->label(false) ?></div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('jumlah') ?></label>
        <div class="col-md-6"><?= $form->field($model, 'jumlah')->textInput(['maxlength' => true])->label(false) ?></div>
    </div>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>