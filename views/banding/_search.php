<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BandingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banding-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_banding') ?>

    <?= $form->field($model, 'tgl_banding') ?>

    <?= $form->field($model, 'id_pegawai') ?>

    <?= $form->field($model, 'id_atasan') ?>

    <?= $form->field($model, 'id_absen') ?>

    <?php // echo $form->field($model, 'alasan') ?>

    <?php // echo $form->field($model, 'file') ?>

    <?php // echo $form->field($model, 'status_banding') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
