<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Eselon;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\UnitKerja;
use app\models\SatuanKerja;

/* @var $this yii\web\View */
/* @var $model app\models\JabatanFungsional */
/* @var $form yii\widgets\ActiveForm */

$js = <<< JS
  $("#jabatanfungsional-nilai_jabatan").on("change",function(){
      var total = parseFloat($(this).val())* parseFloat($("#jabatanfungsional-ikkd").val());
      $("#jabatanfungsional-tpp_dinamis").val(total);

  })
  $("#jabatanfungsional-ikkd").on("change",function(){
      var total = parseFloat($(this).val())* parseFloat($("#jabatanfungsional-nilai_jabatan").val());
      $("#jabatanfungsional-tpp_dinamis").val(total);

  })

JS;

$this->registerJS($js);
$dataEselon = ArrayHelper::map(
    Eselon::find()
        ->select(['id' => 'id_eselon', 'nama' => 'nama_eselon'])
        ->asArray()
        ->all(),
    'id',
    'nama'
);

$dataUnitKerja = ArrayHelper::map(
    UnitKerja::find()
        ->select(['id' => 'id_unit_kerja', 'nama' => 'nama_unit_kerja'])
        ->asArray()
        ->all(),
    'id',
    'nama'
);

$dataSatuanKerja = ArrayHelper::map(
    SatuanKerja::find()
        ->select(['id' => 'id_satuan_kerja', 'nama' => 'nama_satuan_kerja'])
        ->asArray()
        ->all(),
    'id',
    'nama'
);

?>

<div class="jabatan-fungsional-form">


    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->

      <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nama_jabatan_fungsional') ?></label>
        <div class="col-md-6">

    <?= $form->field($model, 'nama_jabatan_fungsional')->textInput(['maxlength' => true])->label(false); ?>
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
</div>
  </div>
   <div class="row">
        <label class="col-md-3 col-form-label">Unit Kerja</label>
        <div class="col-md-6">

    <?= $form->field($model, 'id_unit_kerja')->widget(Select2::className(), [
        'data' => $dataUnitKerja,
        'options' => ['placeholder' => 'Pilih Unit Kerja...'],
        'pluginOptions' => [

            'allowClear' => true,
        ],
    ])->label(false); ?>
</div>
  </div>


   <div class="row">
        <label class="col-md-3 col-form-label">Status Jabatan</label>
        <div class="col-md-6">

    <?= $form->field($model, 'status_jabatan')->widget(Select2::className(), [
        'data' => [
            'Struktural' => 'Struktural',
            'Fungsional Tertentu' => 'Fungsional Tertentu',
           'Fungsional Umum' => 'Fungsional Umum',
        ],
        'options' => ['placeholder' => 'Pilih Status Tunjangan...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])->label(false); ?>
</div>
  </div>


 
</div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>