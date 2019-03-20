<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GolonganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="golongan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_golongan') ?>

    <?= $form->field($model, 'kode_golongan') ?>

    <?= $form->field($model, 'nama_golongan') ?>

    <?= $form->field($model, 'nilai_jabatan') ?>

    <?= $form->field($model, 'ikkd') ?>

    <?php // echo $form->field($model, 'tpp_dinamis') ?>

    <?php // echo $form->field($model, 'tpp_statis') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
