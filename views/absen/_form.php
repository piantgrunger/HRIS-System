<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\JenisAbsen;
use app\models\Pegawai;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$dataJenisAbsen = ArrayHelper::map(
    JenisAbsen::find()
                                                                ->select(['id' => 'id_jenis_absen', 'nama' => 'nama_jenis_absen'])
                                                               ->asArray()
                                                                ->all(),
                                                                'id',
    'nama'
);
$dataPegawai = ArrayHelper::map(
    Pegawai::find()
        ->select(['id' => 'id_pegawai', 'nama' => "concat(nip,' - ',nama)"])
        ->asArray()
        ->all(),
    'id',
    'nama'
);

/* @var $this yii\web\View */
/* @var $model app\models\Absen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="absen-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->
<div class="row">
        <label class="col-md-3 col-form-label">Jenis Absen</label>
`        <div class="col-md-6">

    <?= $form->field($model, 'id_jenis_absen')->widget(Select2::className(), [
        'data' => $dataJenisAbsen,
        'options' => ['placeholder' => 'Pilih Jenis Absen...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])->label(false); ?>
</div>
</div>
<div class="row">
        <label class="col-md-3 col-form-label">Pegawai</label>
`        <div class="col-md-6">

    <?= $form->field($model, 'id_pegawai')->widget(Select2::className(), [
        'data' => $dataPegawai,
        'options' => ['placeholder' => 'Pilih Pegawai...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])->label(false); ?>
    </div>
    </div>

        <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tgl_absen'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'tgl_absen')->textInput(['class' => 'form-control datepicker', 'value' => yii::$app->formatter->asDate($model->tgl_absen, 'd-M-yyyy')])->label(false); ?>
        </div>
    </div>

        <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('masuk_kerja'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'masuk_kerja')->textInput(['class' => 'form-control timepicker'])->label(false); ?>
        </div>
    </div>

        <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('pulang_kerja'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'pulang_kerja')->textInput(['class' => 'form-control timepicker'])->label(false); ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= $this->registerJsFile('@web/creative/assets/js/plugins/moment.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/bootstrap-datetimepicker.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/jasny-bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/js/pegawai.js?v='.date('YmdHis'), ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
