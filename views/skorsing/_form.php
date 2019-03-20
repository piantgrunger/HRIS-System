<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Pegawai;
use yii\helpers\ArrayHelper;

$query = Pegawai::find()
    ->select(['id' => 'id_pegawai', 'nama' => "concat(nip,' - ',coalesce(gelar_depan,''), ' ' ,nama,' ',coalesce(gelar_belakang,''))"]);

if (!is_null(Yii::$app->user->identity->id_satuan_kerja)) {
    $query->where('tb_m_pegawai.id_satuan_kerja=' . Yii::$app->user->identity->id_satuan_kerja);
}

$dataPegawai = ArrayHelper::map(
    $query
        ->asArray()
        ->all(),
    'id',
    'nama'
);
/* @var $this yii\web\View */
/* @var $model app\models\Penilaian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penilaian-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model) ?>
    <!-- ADDED HERE -->

    <div class="row">
        <label class="col-md-3 col-form-label">Pegawai</label>
        <div class="col-md-6">
            <?= $form->field($model, 'id_pegawai')->widget(Select2::className(), ['data' => $dataPegawai, 'options' => ['prompt' => 'Pilih Pegawai  ...']])->label(false); ?>
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