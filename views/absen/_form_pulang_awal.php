<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Absen;
use yii\db\Expression;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use app\models\Pegawai;

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
/* @var $model app\models\Banding */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="banding-form">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->
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
        <label class="col-md-3 col-form-label">Alasan</label>
        <div class="col-md-6">
    <?= $form->field($model, 'alasan')->textarea(['rows' => 6])->label(false); ?>
    </div>
    </div>

    <div class="row">

        <label class="col-md-3 col-form-label">Absen Pulang Awal</label>
        <div class="col-md-6">
            <?= $form->field($model, 'id_absen_terlambat')->widget(DepDrop::classname(), [
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['placeholder' => 'Pilih Absen Pulang Awal ...'],
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions' => [
                    'depends' => ['absen-id_pegawai'],
                    'url' => Url::to(['/absen/data-pulang-awal']),
                    'placeholder' => 'Pilih Absen Pulang Awal ...',
                    'initialize' => true,
                ],
            ])->label(false); ?>
        </div>
    </div>
<div class="row">
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
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= $this->registerJsFile('@web/creative/assets/js/plugins/moment.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/bootstrap-datetimepicker.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/jasny-bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/js/pegawai.js?v='.date('YmdHis'), ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
