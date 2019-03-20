<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\JenisAbsen;
use app\models\Pegawai;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$dataJenisAbsen = ArrayHelper::map(
    JenisAbsen::find()
                                                                ->select(['id' => 'id_jenis_absen', 'nama' => 'nama_jenis_absen'])
                                                                ->where("status_hadir <>'Hadir'")
                                                               ->asArray()
                                                                ->all(),
    'id',
    'nama'
);
$query = Pegawai::find()
->select(['id' => 'id_pegawai', 'nama' => "concat(nip,' - ',coalesce(gelar_depan,''), ' ' ,nama,' ',coalesce(gelar_belakang,''))"]);

if (!is_null(Yii::$app->user->identity->id_satuan_kerja)) {
    $query->where('tb_m_pegawai.id_satuan_kerja='.Yii::$app->user->identity->id_satuan_kerja);
}

$dataPegawai = ArrayHelper::map(
    $query
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

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
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
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tgl_awal'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'tgl_awal')->textInput(['class' => 'form-control datepicker', 'value' => yii::$app->formatter->asDate($model->tgl_absen, 'd-M-yyyy')])->label(false); ?>
        </div>
    </div>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tgl_akhir'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'tgl_akhir')->textInput(['class' => 'form-control datepicker', 'value' => yii::$app->formatter->asDate($model->tgl_absen, 'd-M-yyyy')])->label(false); ?>
        </div>
    </div>


    <div class="row">
        <label class="col-md-3 col-form-label">Alasan</label>
        <div class="col-md-6">
    <?= $form->field($model, 'alasan')->textarea(['rows' => 6])->label(false); ?>
    </div>
    </div>  <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('file_pendukung'); ?></label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                <div class="fileinput-new thumbnail">
                        <a href="<?= Url::to(['/document/'.$model->file_pendukung]); ?>" alt="...">
                         <?=$model->file_pendukung; ?></a>
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                <div>
                    <span class="btn btn-rose btn-round btn-file">
                        <span class="fileinput-new">Select Document</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="Absen[file_pendukung]" />
                    </span>
                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                </div>
            </div>
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success' ,"data"=>["confirm" => "Periksa Lagi Apakah Data Sudah Valid? "]]); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= $this->registerJsFile('@web/creative/assets/js/plugins/moment.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/bootstrap-datetimepicker.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/jasny-bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/js/pegawai.js?v='.date('YmdHis'), ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
