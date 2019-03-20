<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\SatuanKerja;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\BandingSearch */
/* @var $form yii\widgets\ActiveForm */

$dataSatuanKerja = ArrayHelper::map(
    SatuanKerja::find()
            ->select(['id' => 'id_satuan_kerja', 'nama' => 'nama_satuan_kerja'])
        ->where(" id_satuan_kerja " . (is_null(Yii::$app->user->identity->id_satuan_kerja) ? "is not null " : " = " . Yii::$app->user->identity->id_satuan_kerja))
            ->asArray()
            ->all(),
'id',
'nama'
);

?>


<div class="banding-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
        ],
    ]); ?>
            <div class="row">
            <label class="col-md-3 col-form-label">Bulan</label>
            <div class="col-md-6">
    <?= $form->field($model, 'bulan')->dropDownList(\app\helpers\myhelpers::getMonths(), ['prompt' => 'Pilih Bulan...'])->label(false); ?>


</div>
</div>
<div class="row">
            <label class="col-md-3 col-form-label">Tahun</label>
            <div class="col-md-6">
    <?= $form->field($model, 'tahun')->textInput()->label(false); ?>


</div>
</div>


<div class="row">
        <label class="col-md-3 col-form-label">Satuan Kerja</label>
        <div class="col-md-6">
            <?= $form->field($model, 'id_satuan_kerja')->widget(Select2::className(), ['data' => $dataSatuanKerja, 'options' => ['prompt' => 'Pilih Satuan Kerja...']])->label(false); ?>
        </div>
    </div>


<div class="row">

    <div class="col-md-4">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']); ?>
          <?=!is_null($model->id_satuan_kerja) ?Html::a("Cetak", ["cetak","bulan"=>$model->bulan,"tahun" =>$model->tahun,"id_satuan_kerja" => $model->id_satuan_kerja], ['class' => 'btn btn-info']) :""?>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
