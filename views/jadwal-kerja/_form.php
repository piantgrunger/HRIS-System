<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\SatuanKerja;
use kartik\widgets\DepDrop;

use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\JadwalKerja */
/* @var $form yii\widgets\ActiveForm */


$dataSatuanKerja = ArrayHelper::map(
    SatuanKerja::find()
                        ->select(['id' => 'id_satuan_kerja', 'nama' => 'nama_satuan_kerja'])
                        ->asArray()
                        ->all(),
    'id',
    'nama'
);
?>


<div class="jadwal-kerja-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

        <div class="row">
        <label class="col-md-3 col-form-label">Satuan Kerja</label>
        <div class="col-md-6">
            <?= $form->field($model, 'id_satuan_kerja')->widget(Select2::className(), ['data' => $dataSatuanKerja, 'options' => ['prompt' => 'Pilih Satuan Kerja...']])->label(false); ?>
        </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label">Unit Kerja</label>
        <div class="col-md-6">
            <?= $form->field($model, 'id_unit_kerja')->widget(DepDrop::classname(), [
                'type' => DepDrop::TYPE_SELECT2,
                'data' => [$model->id_unit_kerja => $model->nama_unit_kerja],
                'options' => ['placeholder' => 'Pilih Unit Kerja ...'],
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['jadwalkerja-id_satuan_kerja'],
                    'url' => Url::to(['/jadwal-kerja/unit-kerja']),
                    'placeholder' => 'Pilih Unit Kerja ...',
                    'initialize' => true,
                ],
            ])->label(false); ?>
        </div>
    </div>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tanggal_awal'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'tanggal_awal')->textInput(['class' => 'form-control datepicker', 'value' => yii::$app->formatter->asDate($model->tanggal_awal, 'd-M-yyyy')])->label(false); ?>
        </div>
    </div>


    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tanggal_akhir'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'tanggal_akhir')->textInput(['class' => 'form-control datepicker', 'value' => yii::$app->formatter->asDate($model->tanggal_akhir, 'd-M-yyyy')])->label(false); ?>
        </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('keterangan'); ?></label>
        <div class="col-md-6">

            <?= $form->field($model, 'keterangan')->textarea(['rows' => 6])->label(false) ?>
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