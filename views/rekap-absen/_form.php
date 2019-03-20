<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RekapAbsen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rekap-absen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_pegawai')->textInput() ?>

    <?= $form->field($model, 'bulan')->textInput() ?>

    <?= $form->field($model, 'tahun')->textInput() ?>

    <?= $form->field($model, 'terlambat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanpa_keterangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ijin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuti')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'libur')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
