<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Golongan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="golongan-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

<div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('kode_golongan') ?></label>
`        <div class="col-md-6">

    <?= $form->field($model, 'kode_golongan')->textInput(['maxlength' => true])->label(false); ?>
</div>
</div>
<div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nama_golongan') ?></label>
`        <div class="col-md-6">

    <?= $form->field($model, 'nama_golongan')->textInput(['maxlength' => true])->label(false); ?>
</div>
</div>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nilai_jabatan') ?></label>
`        <div class="col-md-6">



    <?= $form->field($model, 'nilai_jabatan')->textInput(['maxlength' => true])->label(false); ?>
</div>
</div>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('ikkd') ?></label>
`        <div class="col-md-6">


    <?= $form->field($model, 'ikkd')->textInput(['maxlength' => true])->label(false); ?>
</div>
</div>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tpp_dinamis') ?></label>
`        <div class="col-md-6">


    <?= $form->field($model, 'tpp_dinamis')->textInput(['maxlength' => true])->label(false); ?>
</div>
</div>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tpp_statis') ?></label>
`        <div class="col-md-6">


    <?= $form->field($model, 'tpp_statis')->textInput(['maxlength' => true])->label(false); ?>
</div>
</div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
