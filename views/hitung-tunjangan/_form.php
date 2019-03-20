<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use app\models\SatuanKerja;
use dmstr\widgets\Alert;

use yii\helpers\ArrayHelper;

$datasatuanKerja = ArrayHelper::map(
    SatuanKerja::find()
        ->select(['id' => 'id_satuan_kerja', 'nama' => 'nama_satuan_kerja'])
        ->where(" id_satuan_kerja " . (is_null(Yii::$app->user->identity->id_satuan_kerja) ? "is not null " : " = " . Yii::$app->user->identity->id_satuan_kerja))

        ->asArray()
        ->all(),
    'id',
    'nama'
);

/* @var $this yii\web\View */
/* @var $model app\models\HitungTunjangan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hitung-tunjangan-form">
    <?= Alert::widget(); // echo $this->render('_search', ['model' => $searchModel]);?>;

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

        <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tgl_awal') ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'tgl_awal')->textInput(['class' => 'form-control datepicker'])->label(false); ?>
        </div>
    </div>

   <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tgl_akhir') ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'tgl_akhir')->textInput(['class' => 'form-control datepicker'])->label(false); ?>
        </div>
    </div>
  <div class="row">
        <label class="col-md-3 col-form-label">Satuan Kerja</label>
        <div class="col-md-6">

    <?= $form->field($model, 'id_satuan_kerja')->widget(Select2::className(), [
        'data' => $datasatuanKerja,
        'options' => ['placeholder' => 'Pilih satuan Kerja...'],
        'pluginOptions' => [
            'allowClear' => true,
            'disabled' => !is_null(Yii::$app->user->identity->id_satuan_kerja),
        ],
    ])->label(false); ?>
       </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/moment.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/bootstrap-datetimepicker.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/jasny-bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/js/pegawai.js?v=' . date('YmdHis'), ['depends' => [\yii\web\JqueryAsset::className()]]); ?>