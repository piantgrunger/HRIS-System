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

$dataSatuanKerja = ArrayHelper::map(
    SatuanKerja::find()
                        ->select(['id' => 'id_satuan_kerja', 'nama' => 'nama_satuan_kerja'])
                        ->asArray()
                        ->all(),
    'id',
    'nama'
);
$dataJabatan = ArrayHelper::map(
    JabatanFungsional::find()
                        ->select(['id' => 'id_jabatan_fungsional', 'nama' => 'nama_jabatan_fungsional'])
                        ->asArray()
                        ->all(),
    'id',
    'nama'
);
$dataJabatanTambahan = ArrayHelper::map(
    JabatanTambahan::find()
        ->select(['id' => 'id_jabatan_tambahan', 'nama' => 'nama_jabatan'])
        ->asArray()
        ->all(),
    'id',
    'nama'
);

$dataGolongan = ArrayHelper::map(
    Golongan::find()
                        ->select(['id' => 'id_golongan', 'nama' => 'nama_golongan'])
                        ->asArray()
                        ->all(),
    'id',
    'nama'
);

$dataShift = ArrayHelper::map(
    Shift::find()
                        ->select(['id' => 'id_shift', 'nama' => 'nama_shift'])
                        ->asArray()
                        ->all(),
    'id',
    'nama'
);

$dataJenis = ArrayHelper::map(
    Pegawai::find()
            ->select(['id' => 'jenis_pegawai', 'nama' => 'jenis_pegawai'])
            ->distinct()
            ->asArray()
            ->all(),
    'id',
    'nama'
);

/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pegawai-form">

    <?php $form = ActiveForm::begin(['id' => 'form-modules', 'class' => 'form-horizontal', 'method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>    <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->

    <div class="row">
        <label class="col-md-3 col-form-label">Jenis Pegawai</label>
        <div class="col-md-6">
            <?= $form->field($model, 'jenis_pegawai')->widget(Select2::className(), ['data' => $dataJenis, 'options' => ['prompt' => 'Pilih Jenis Pegawai...']])->label(false); ?>
        </div>
    </div>

`    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nip'); ?></label>
`        <div class="col-md-6">
            <?= $form->field($model, 'nip')->textInput(['maxlength' => true])->label(false); ?>
        </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nik'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'nik')->textInput(['maxlength' => true])->label(false); ?>
        </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nama'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'nama')->textInput(['maxlength' => true])->label(false); ?>
        </div>
    </div>


    <?php /*
      $form->field($model, 'foto')->widget(FileInput::classname(), [
      'options' => ['multiple ' => false],
      'pluginOptions' => [
      'overwriteInitial' => true,
      'showUpload' => false,
      'initialPreview' => [Url::to(['/media\/' . $model->foto], true)],
      'initialPreviewFileType' => 'image', // image is the default and can be overridden in config below
      'initialCaption' => $model->foto,
      'initialPreviewAsData' => true,
      ],
      ]); */
    ?>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('gelar_depan'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'gelar_depan')->textInput(['maxlength' => true])->label(false); ?>
        </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('gelar_belakang'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'gelar_belakang')->textInput(['maxlength' => true])->label(false); ?>
        </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('alamat'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'alamat')->textarea(['rows' => 6])->label(false); ?>
        </div>
    </div>

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
                    'depends' => ['pegawai-id_satuan_kerja'],
                    'url' => Url::to(['/pegawai/unit-kerja']),
                    'placeholder' => 'Pilih Unit Kerja ...',
                    'initialize' => true,
                ],
            ])->label(false); ?>
        </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label">Jabatan</label>
        <div class="col-md-6">
   <?= $form->field($model, 'id_jabatan_fungsional')->widget(DepDrop::classname(), [
        'type' => DepDrop::TYPE_SELECT2,
        'data' => [$model->id_jabatan_fungsional => $model->nama_jabatan],
        'options' => ['placeholder' => 'Pilih Jabatan ...'],
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'depends' => ['pegawai-id_satuan_kerja'],
            'url' => Url::to(['/pegawai/jabatan']),
            'placeholder' => 'Pilih Jabatan ...',
            'initialize' => true,
        ],
    ])->label(false); ?>        </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tmt'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'tmt')->textInput(['class' => 'form-control datepicker', 'value' => yii::$app->formatter->asDate($model->tmt, 'd-M-yyyy')])

                ->label(false); ?>
        </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label">Jabatan Tambahan</label>
        <div class="col-md-6">
            <?= $form->field($model, 'id_jabatan_tambahan')->widget(
                    Select2::className(),
                    ['data' => $dataJabatanTambahan, 'options' => ['prompt' => 'Pilih Jabatan Tambahan...' , ],
                    'pluginOptions' =>['allowClear' => true]
                    ]
                )->label(false); ?>
        </div>
    </div>
        <div class="row">
        <label class="col-md-3 col-form-label">Atasan</label>
        <div class="col-md-6">
            <?= $form->field($model, 'id_atasan')->widget(DepDrop::classname(), [
                'type' => DepDrop::TYPE_SELECT2,
                'data' => [$model->id_atasan => $model->nama_atasan],
                'options' => ['placeholder' => 'Pilih Atasan ...'],
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['pegawai-id_satuan_kerja'],
                    'url' => Url::to(['/pegawai/jabatan-atasan']),
                    'placeholder' => 'Pilih Atasan ...',
                    'initialize' => true,
                ],
            ])->label(false); ?>
        </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('jenis_kelamin'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'jenis_kelamin')->dropDownList(['L' => 'Laki Laki', 'P' => 'Perempuan'], ['prompt' => 'Pilih Jenis Kelamin...'])->label(false); ?>
        </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tempat_lahir'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true])->label(false); ?>
        </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tanggal_lahir'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'tanggal_lahir')->textInput(['class' => 'form-control datepicker', 'value' => yii::$app->formatter->asDate($model->tanggal_lahir, 'd-M-yyyy')])

            ->label(false); ?>
        </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label">Shift</label>
        <div class="col-md-6">
            <?= $form->field($model, 'id_shift')->widget(Select2::className(), ['data' => $dataShift, 'options' => ['prompt' => 'Pilih Shift ...']])->label(false); ?>
        </div>
    </div>


    <div class="row">
        <label class="col-md-3 col-form-label">Golongan</label>
        <div class="col-md-6">
            <?= $form->field($model, 'id_golongan')->widget(Select2::className(), ['data' => $dataGolongan,
             'options' => ['prompt' => 'Pilih Golongan...',
             'disabled' => !Mimin::checkRoute($this->context->id.'/golongan'),
             ], ])->label(false); ?>
        </div>
    </div>



    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('kode_checklog'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'kode_checklog')->textInput(['maxlength' => true,    'readOnly' => !Mimin::checkRoute($this->context->id.'/golongan')])->label(false); ?>
        </div>
    </div>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('foto'); ?></label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                <div class="fileinput-new thumbnail">
                    <img src="<?=Url::to(['/media/'.$model->foto]); ?>" alt="...">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                <div>
                    <span class="btn btn-rose btn-round btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="Pegawai[foto]" />
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