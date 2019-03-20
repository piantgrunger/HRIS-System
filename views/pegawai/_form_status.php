<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pegawai-form">

    <?php $form = ActiveForm::begin(['id' => 'form-modules', 'class' => 'form-horizontal', 'method' => 'post', 'options' => ['enctype' => 'multipart/form-data','data-pjax' =>true]]); ?>
       <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->



    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('status') ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->widget(Select2::className(), ['data' => ['Pensiun' =>'Pensiun' ,'Mengundurkan Diri' => 'Mengundurkan Diri' ,'Meninggal Dunia' =>'Meninggal Dunia' ], 'options' => ['prompt' => 'Pilih Status Pegawai ...']])->label(false); ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>