
<?php


use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TugasTambahan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tugas-tambahan-form">

<?php $form = ActiveForm::begin(['id' => 'form-modules', 'class' => 'form-horizontal', 'method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>    <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->

        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->



        <div class="row">
        <label class="col-md-2 col-form-label">Uraian Tugas</label>
`           <label class="col-md-8 col-form-label text-left justify-content-start"><?= $form->field($model, 'uraian_tugas')->textarea(['rows' => 4])->label(false); ?></label>
    </div>


<br>
<br>






    <div class="row">
        <label class="col-md-2 col-form-label">File Pendukung</label>
        <div class="col-md-6">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                <div class="fileinput-new thumbnail">
                    <a Href="<?=Url::to(['/media/'.$model->file_pendukung]); ?>" > File Pendukung </a>
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                <div>
                    <span class="btn btn-rose btn-round btn-file">
                        <span class="fileinput-new">Select File</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="TugasTambahan[file_pendukung]" />
                    </span>
                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                </div>
            </div>
        </div>
    </div>
    




    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>


    <?= $form->field($model, 'id_pegawai')->hiddenInput()->label(false); ?>

<?= $form->field($model, 'id_penilai')->hiddenInput()->label(false); ?>

<?= $form->field($model, 'tahun')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'bulan')->hiddenInput()->label(false); ?>
    <?php ActiveForm::end(); ?>

</div>


<?= $this->registerJsFile('@web/creative/assets/js/plugins/moment.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/bootstrap-datetimepicker.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/creative/assets/js/plugins/jasny-bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/js/pegawai.js?v='.date('YmdHis'), ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
