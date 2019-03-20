<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$js = <<< JS
  $("#eselon-nilai_jabatan").on("change",function(){
      var total = parseFloat($(this).val())* parseFloat($("#eselon-ikkd").val());
      $("#eselon-tpp_dinamis").val(total);

  })
  $("#eselon-ikkd").on("change",function(){
      var total = parseFloat($(this).val())* parseFloat($("#eselon-nilai_jabatan").val());
      $("#eselon-tpp_dinamis").val(total);

  })

JS;

$this->registerJS($js);

/* @var $this yii\web\View */
/* @var $model app\models\Eselon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="eselon-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nama_eselon') ?></label>
`        <div class="col-md-6">

    <?= $form->field($model, 'nama_eselon')->textInput(['maxlength' => true])->label(false); ?>
</div>
</div>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nilai_jabatan') ?></label>
`        <div class="col-md-6">



    <?= $form->field($model, 'nilai_jabatan')->textInput(['maxlength' => true])->label(false); ?>
</div>
</div>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('ikkd') ?></label>
`        <div class="col-md-6">


    <?= $form->field($model, 'ikkd')->textInput(['maxlength' => true])->label(false); ?>
</div>
</div>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tpp_dinamis') ?></label>
`        <div class="col-md-6">


    <?= $form->field($model, 'tpp_dinamis')->textInput(['maxlength' => true,'readOnly' =>true])->label(false); ?>
</div>
</div>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tpp_statis') ?></label>
`        <div class="col-md-6">


    <?= $form->field($model, 'tpp_statis')->textInput(['maxlength' => true])->label(false); ?>
</div>
</div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
