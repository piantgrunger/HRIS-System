<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RealisasiSasaranKerjaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="realisasi-sasaran-kerja-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_realisasi') ?>

    <?= $form->field($model, 'id_skp') ?>

    <?= $form->field($model, 'id_d_skp') ?>

    <?= $form->field($model, 'kuantitas') ?>

    <?= $form->field($model, 'file_pendukung') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
