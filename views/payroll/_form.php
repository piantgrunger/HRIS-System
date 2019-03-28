<?php

use hscstudio\mimin\components\Mimin;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\UnitKerja;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
//use kartik\datecontrol\DateControl;
use app\models\JabatanFungsional;
use app\models\JabatanTambahan;
use app\models\Golongan;
use app\models\Shift;
use app\models\SatuanKerja;
use app\models\Pegawai;

//use kartik\widgets\FileInput;
/*
$dataUnitKerja = ArrayHelper::map(
                UnitKerja::find()
                        ->select(['id' => 'id_unit_kerja', 'nama' => 'nama_unit_kerja'])
                        ->asArray()
                        ->all(),
    'id',
    'nama'
);
*/



/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pegawai-form">

    <?php $form = ActiveForm::begin(['id' => 'form-modules', 'class' => 'form-horizontal', 'method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>    <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->

 
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nip'); ?></label>
        <div class="col-md-6">       <?= $form->field($model, 'nip')->textInput(['maxlength' => true,'readOnly' => true ])->label(false); ?>
    </div>
    </div>

  
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nama'); ?></label>
        <div class="col-md-6">        <?= $form->field($model, 'nama')->textInput(['maxlength' => true,'readOnly' => true])->label(false); ?>
 
    </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('gaji_pokok'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'gaji_pokok')->textInput(['maxlength' => true])->label(false); ?>
        </div>
    </div>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('gaji_lembur'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'gaji_lembur')->textInput(['maxlength' => true])->label(false); ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
