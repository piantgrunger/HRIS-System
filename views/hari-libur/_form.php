<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use  kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\models\HariLibur */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hari-libur-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->
        <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nama_hari_libur') ?></label>
        <div class="col-md-6">

    <?= $form->field($model, 'nama_hari_libur')->textInput(['maxlength' => true])
->label(false); ?>
        </div>
    </div>

        <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('tanggal_libur') ?></label>
        <div class="col-md-6">

    <?= $form->field($model, 'tanggal_libur') ->textInput(['class' => 'form-control datepicker', 'value' => yii::$app->formatter->asDate($model->tanggal_libur, 'd-M-yyyy')])->label(false); ?>
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
