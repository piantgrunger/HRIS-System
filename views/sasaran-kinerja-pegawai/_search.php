<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SasaranKinerjaPegawaiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sasaran-kinerja-pegawai-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>


    <?php // echo $form->field($model, 'kuantitas')?>

    <?php // echo $form->field($model, 'satuan_kuantitas')?>

    <?php // echo $form->field($model, 'waktu')?>

    <?php // echo $form->field($model, 'satuan_waktu')?>

    <?php // echo $form->field($model, 'biaya')?>

<div class="row">
    <label class="col-md-1 col-form-label">Tahun</label>

`           <label class="col-md-5 col-form-label text-left justify-content-start">
    <?php echo $form->field($model, 'tahun')->textInput(['maxlength' => true]) ->label(false)?>
</label>
</div>

    <?php ActiveForm::end(); ?>

</div>
