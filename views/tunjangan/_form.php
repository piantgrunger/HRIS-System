<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tunjangan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tunjangan-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

     <div class="row">
        <label class="col-md-3 col-form-label"><?=$model->getAttributeLabel('kode_tunjangan') ?></label>
        <div class="col-md-6"><?=$form->field($model, 'kode_tunjangan')->textInput(['maxlength' => true])->label(false)?></div></div> 

     <div class="row">
        <label class="col-md-3 col-form-label"><?=$model->getAttributeLabel('nama_tunjangan') ?></label>
        <div class="col-md-6"><?=$form->field($model, 'nama_tunjangan')->textInput(['maxlength' => true])->label(false)?></div></div> 

     <div class="row">
        <label class="col-md-3 col-form-label"><?=$model->getAttributeLabel('jenis_tunjangan') ?></label>
        <div class="col-md-6"><?=$form->field($model, 'jenis_tunjangan')->textInput(['maxlength' => true])->label(false)?></div></div> 

     <div class="row">
        <label class="col-md-3 col-form-label"><?=$model->getAttributeLabel('jumlah') ?></label>
        <div class="col-md-6"><?=$form->field($model, 'jumlah')->textInput(['maxlength' => true])->label(false)?></div></div> 

      

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
