<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RiwayatJabatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="riwayat-jabatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_riwayat_jabatan') ?>

    <?= $form->field($model, 'id_pegawai') ?>

    <?= $form->field($model, 'id_jabatan') ?>

    <?= $form->field($model, 'nama_jabatan') ?>

    <?= $form->field($model, 'unit_kerja') ?>

    <?php // echo $form->field($model, 'tmt') ?>

    <?php // echo $form->field($model, 'no_sk') ?>

    <?php // echo $form->field($model, 'pejabat') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
