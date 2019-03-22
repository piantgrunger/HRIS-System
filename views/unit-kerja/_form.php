<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\SatuanKerja;



$dataSatuanKerja = ArrayHelper::map(
    SatuanKerja::find()
                        ->select(['id' => 'id_satuan_kerja', 'nama' => 'nama_satuan_kerja'])
                        ->asArray()
                        ->all(),
    'id',
    'nama'
);
/* @var $this yii\web\View */
/* @var $model app\models\UnitKerja */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unit-kerja-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->
<div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('kode_unit_kerja') ?></label>
        <div class="col-md-6">

    <?= $form->field($model, 'kode_unit_kerja')->textInput(['maxlength' => true])->label(false); ?>
        </div>
    </div>


<div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nama_unit_kerja') ?></label>
        <div class="col-md-6">

    <?= $form->field($model, 'nama_unit_kerja')->textInput(['maxlength' => true])->label(false); ?>
        </div>
    </div>


    <div class="row">
        <label class="col-md-3 col-form-label">Satuan Kerja</label>
        <div class="col-md-6">
<?= $form->field($model, 'id_satuan_kerja')->widget(Select2::className(), [
        'data' => $dataSatuanKerja,
        'options' => ['placeholder' => 'Pilih Satuan Kerja...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
