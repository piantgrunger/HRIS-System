<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JabatanFungsionalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jabatan-fungsional-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_jabatan_fungsional') ?>

    <?= $form->field($model, 'kode_jabatan_fungsional') ?>

    <?= $form->field($model, 'nama_jabatan_fungsional') ?>

    <?= $form->field($model, 'ruang_awal') ?>

    <?= $form->field($model, 'ruang_akhir') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
