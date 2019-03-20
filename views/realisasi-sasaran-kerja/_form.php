<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\SasaranKinerjaPegawai;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\widgets\DepDrop;

$dataSKP = ArrayHelper::map(
       SasaranKinerjaPegawai::find()->select(['id_skp', 'uraian_tugas'])->where(['id_pegawai' => Yii::$app->user->identity->id_pegawai])
       ->andWhere(['status_skp' => 'Disetujui'])
       ->all(),
       'id_skp',
       'uraian_tugas'
);

/* @var $this yii\web\View */
/* @var $model app\models\RealisasiSasaranKerja */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="realisasi-sasaran-kerja-form">

<?php $form = ActiveForm::begin(['id' => 'form-modules', 'class' => 'form-horizontal', 'method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>    <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->

        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->

        <div class="row">
        <label class="col-md-2 col-form-label">SKP</label>
`           <div class="col-md-8"><?= $form->field($model, 'id_skp')->widget(Select2::className(),
                ['data' => $dataSKP, 'options' => ['prompt' => 'Pilih Sasaran Kinerja...']])->label(false); ?></div>
    </div>



    <div class="row">
        <label class="col-md-2 col-form-label">Bulan Realisasi</label>
        <div class="col-md-8">
            <?= $form->field($model, 'id_d_skp')->widget(DepDrop::classname(), [
                'type' => DepDrop::TYPE_SELECT2,
                'data' => [$model->id_d_skp => $model->id_d_skp],
                'options' => ['placeholder' => 'Pilih Unit Kerja ...'],
                'select2Options' => ['pluginOptions' => ['allowClear' => true],
                'pluginEvents' => [
                    'select2:select' => "function(e) {  
                              $.post( '".Url::to(['realisasi-sasaran-kerja/detail-skp'])."?id=' +$(this).val(), function(data) {
                                data1 = JSON.parse(data);
                            
                                $( '#lblSatuanSasaraqn' ).text(data1.satuan_kuantitas);
                                $( '#lblQtySasaran' ).text(data1.kuantitas);
                                $( '#lblSatuan' ).text(data1.satuan_kuantitas);
}
);

}",
                    ],
            ],
                'pluginOptions' => [
                    'depends' => ['realisasisasarankerja-id_skp'],
                    'url' => Url::to(['/realisasi-sasaran-kerja/skp']),
                    'placeholder' => 'Pilih Bulan Realisasi ...',
                    'initialize' => true,
                ],
            ])->label(false); ?>
        </div>
    </div>
    <div class="row">
        <label class="col-md-2 col-form-label">Kuantitas Sasaran</label>
        <label class="col-md-2 col-form-label text-left" id="lblQtySasaran">  </label>
    <label class="col-md-2 col-form-label text-left" id="lblSatuanSasaran">  </label>
    </div>


    <div class="row">
        <label class="col-md-2 col-form-label">Kuantitas Realisasi</label>
        <div class="col-md-6">
    <?= $form->field($model, 'kuantitas')->textInput(['maxlength' => true])->label(false); ?>
    
    </div>
    <label class="col-md-2 col-form-label text-left" id="lblSatuan">  </label>
    </div>


    <div class="row">
        <label class="col-md-2 col-form-label">File Pendukung</label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                <div class="fileinput-new thumbnail">
                    <a Href="<?=Url::to(['/document/'.$model->file_pendukung]); ?>" > File Pendukung </a>
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                <div>
                    <span class="btn btn-rose btn-round btn-file">
                        <span class="fileinput-new">Select File</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="RealisasiSasaranKerja[file_pendukung]" />
                    </span>
                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                </div>
            </div>
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