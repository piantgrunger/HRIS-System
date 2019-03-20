<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\settings\Roles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="roles-form">

    <?php $form = ActiveForm::begin(['id' => 'form-roles', 'class' => 'form-horizontal', 'method' => 'post']); ?>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('name') ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput()->label(false); ?>
        </div>
    </div>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('display_name') ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'display_name')->textInput()->label(false); ?>
        </div>
    </div>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('description') ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'description')->textInput()->label(false); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= Html::submitButton('<i class="material-icons">save</i> Save', ['class' => 'btn btn-fill btn-rose']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
