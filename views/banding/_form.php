<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Absen;
use yii\db\Expression;
use kartik\select2\Select2;
use yii\helpers\Url;

$dataAbsen = ArrayHelper::map(
    Absen::find()->where(['id_pegawai' => $model->id_pegawai])
    ->select(['id_absen', 'ket' => new Expression("concat( DATE_FORMAT(tgl_absen,'%d  -%m - %Y') ,' Potongan ', round(coalesce(total_jam_potong,0))  ,' Jam ' )")])
    ->andWhere(new Expression('YEAR(tgl_absen) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)'))
    ->andWhere(new Expression('MONTH(tgl_absen) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)'))
    ->andWhere(['or', ['>', 'total_jam_potong', 0], ['or', ['>', 'terlambat_kerja', 0], ['>', 'pulang_awal', 0]]])

    ->asArray()
    ->all(),
    'id_absen',
    'ket'
);
/* @var $this yii\web\View */
/* @var $model app\models\Banding */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="banding-form">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->


        <div class="row">
        <label class="col-md-3 col-form-label">Atasan</label>
`           <label class="col-md-6 col-form-label text-left justify-content-start"><?=$model->nama_atasan; ?></label>
</div>
<div class="row">
<label class="col-md-3 col-form-label"></label>
<label class="col-md-6 col-form-label text-left justify-content-start"><?=$model->atasan->nama_jabatan; ?> &nbsp;<?=$model->atasan->nama_satuan_kerja; ?> </label>
       </div>
<br>
<br>

       <div class="row">
        <label class="col-md-3 col-form-label">Absen
        </label>
        <div class="col-md-6">
    <?= $form->field($model, 'id_absen')->widget(Select2::classname(), [
   'data' => $dataAbsen,
   'options' => ['placeholder' => 'Pilih  Absen...'],
   'pluginOptions' => [
       'allowClear' => true,
   ],
    ])->label(false); ?>
    </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label">Pembelaan</label>
        <div class="col-md-6">
    <?= $form->field($model, 'alasan')->textarea(['rows' => 6])->label(false); ?>
    </div>
    </div>  <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('file_pendukung') ?></label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                <div class="fileinput-new thumbnail">
                        <a href="<?= Url::to(['/document/' . $model->file]) ?>" alt="...">
                         <?=$model->file?></a>
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                <div>
                    <span class="btn btn-rose btn-round btn-file">
                        <span class="fileinput-new">Select Document</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="Banding[file]" />
                    </span>
                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?= $form->field($model, 'tgl_banding')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'id_pegawai')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'id_atasan')->hiddenInput()->label(false); ?>
    <?php ActiveForm::end(); ?>

</div>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/moment.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/bootstrap-datetimepicker.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/jasny-bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/js/pegawai.js?v=' . date('YmdHis'), ['depends' => [\yii\web\JqueryAsset::className()]]); ?>