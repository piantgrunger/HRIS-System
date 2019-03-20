<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\myhelpers;
use kartik\select2\Select2;
use app\models\Pegawai;
use yii\helpers\ArrayHelper;

$dataPegawai = ArrayHelper::map(
  Pegawai::find()->select(["id_pegawai"=>"id_pegawai","ket"=>"concat(nip,'-',gelar_depan,' ',nama)"])
  ->where("id_atasan=".Yii::$app->user->identity->pegawai->id_jabatan_fungsional)
  ->asArray()
  ->all(),
  'id_pegawai',
  'ket'

);
/* @var $this yii\web\View */
/* @var $model app\models\Penilaian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penilaian-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

  <div class="row">
        <label class="col-md-3 col-form-label">Pegawai</label>
        <div class="col-md-6">
            <?= $form->field($model, 'id_pegawai')->widget(Select2::className(), ['data' =>$dataPegawai, 'options' => ['prompt' => 'Pilih Pegawai Bawahan ...']])->label(false); ?>
        </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label">Bulan</label>
        <div class="col-md-6">
            <?= $form->field($model, 'bulan')->widget(Select2::className(), ['data' => myhelpers::getMonths(), 'options' => ['prompt' => 'Pilih Bulan ...']])->label(false); ?>
        </div>
    </div>


    <div class="row">
        <label class="col-md-3 col-form-label">Tahun</label>
        <div class="col-md-6">
    <?= $form->field($model, 'tahun')->textInput()->label(false) ?>
</div>
    </div>
    <div class="row">
        <label class="col-md-3 col-form-label">Orientasi Pelayanan</label>
        <div class="col-md-6">

    <?= $form->field($model, 'orientasi_pelayanan')->textInput(['maxlength' => true])->label(false) ?>
</div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label">Integritas</label>
        <div class="col-md-6">

    <?= $form->field($model, 'integritas')->textInput(['maxlength' => true])->label(false) ?>
</div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label">Komitmen</label>
        <div class="col-md-6">

    <?= $form->field($model, 'komitmen')->textInput(['maxlength' => true])->label(false) ?>
</div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label">Disiplin</label>
        <div class="col-md-6">

    <?= $form->field($model, 'disiplin')->textInput(['maxlength' => true])->label(false) ?>
</div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label">Kerjasama</label>
        <div class="col-md-6">

    <?= $form->field($model, 'kerjasama')->textInput(['maxlength' => true])->label(false) ?>
</div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label">Kepemimpinan</label>
        <div class="col-md-6">

    <?= $form->field($model, 'kepemimpinan')->textInput(['maxlength' => true])->label(false) ?>

</div>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>



    <?php ActiveForm::end(); ?>

</div>
