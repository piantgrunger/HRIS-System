<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\settings\Modules */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modules-form">
    <?php $form = ActiveForm::begin(['id' => 'form-modules', 'class' => 'form-horizontal', 'method' => 'post']); ?>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('name') ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(false) ?>
        </div>
    </div>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('label') ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'label')->textInput(['maxlength' => true])->label(false) ?>
        </div>
    </div>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('url') ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'url')->textInput()->label(false); ?>
        </div>
    </div>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('fa_icon') ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'fa_icon')->textInput()->label(false); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= Html::submitButton('<i class="material-icons">save</i> Save', ['class' => 'btn btn-fill btn-rose']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
