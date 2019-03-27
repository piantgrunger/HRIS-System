<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JenisAbsen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jenis-absen-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

     <div class="row">
        <label class="col-md-3 col-form-label"><?=$model->getAttributeLabel('nama_jenis_absen') ?></label>
        <div class="col-md-6"><?=$form->field($model, 'nama_jenis_absen')->textInput(['maxlength' => true])->label(false)?></div></div> 

     <div class="row">
        <label class="col-md-3 col-form-label"><?=$model->getAttributeLabel('status_hadir') ?></label>
        <div class="col-md-6"><?=$form->field($model, 'status_hadir')->dropDownList([ 'Hadir' => 'Hadir', 'Tidak Hadir' => 'Tidak Hadir', ], ['prompt' => ''])->label(false)?></div></div> 

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
