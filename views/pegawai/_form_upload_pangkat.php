<?php

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


$dataGolongan = ArrayHelper::map(
    Golongan::find()
        ->select(['id' => 'id_golongan', 'nama' => 'nama_golongan'])
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
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tmt'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'tmt')->textInput(['class' => 'form-control datepicker', 'value' => yii::$app->formatter->asDate($model->tmt, 'd-M-yyyy')])

                ->label(false); ?>
        </div>
    </div>


    <div class="row">
        <label class="col-md-3 col-form-label">Golongan</label>
        <div class="col-md-6">
            <?= $form->field($model, 'id_golongan')->widget(Select2::className(), ['data' => $dataGolongan, 'options' => ['prompt' => 'Pilih Golongan...']])->label(false); ?>
        </div>
    </div>



    <div class="row">
        <label class="col-md-3 col-form-label">File Pangkat</label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                <div class="fileinput-new thumbnail">
                    <img src="<?= Url::to(['/media/' . $model->file]); ?>" alt="...">
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
<?= $this->registerJsFile('@web/js/pegawai.js?v=' . date('YmdHis'), ['depends' => [\yii\web\JqueryAsset::className()]]); ?>