<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LevelJabatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="level-jabatan-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'nama_level_jabatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kelas_level_jabatan')->textInput() ?>

    <?= $form->field($model, 'nilai_jabatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ikkd')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tpp_dinamis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tpp_statis')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
