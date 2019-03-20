<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JabatanTambahan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jabatan-tambahan-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

        <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nama_tambahan') ?></label>
        <div class="col-md-6">
    <?= $form->field($model, 'nama_jabatan')->textInput(['maxlength' => true])->label(false) ?>
    </div>
    </div>
         <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tunjangan_tpp') ?></label>
        <div class="col-md-6">

    <?= $form->field($model, 'tunjangan_tpp')->textInput(['maxlength' => true])->label(false) ?>
    </div>
    </div>

        <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tambahan_tpp') ?></label>
        <div class="col-md-6">

    <?= $form->field($model, 'tambahan_tpp')->textInput(['maxlength' => true])->label(false) ?>
    </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
