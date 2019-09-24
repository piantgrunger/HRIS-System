<?php

use hscstudio\mimin\components\Mimin;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;

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



/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pegawai-form">

    <?php $form = ActiveForm::begin(['id' => 'form-modules', 'class' => 'form-horizontal', 'method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>    <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->

<?php

$items = [
    [
        'label' => 'Tunjangan',
        'content' => $this->render('_tab_tunjangan.php', ['model' => $model, 'form' => $form]),
        'active' => true
    ],
    [
        'label' => 'Potongan',
        'content' => $this->render('_tab_potongan.php', ['model' => $model, 'form' => $form]),
      
    ],
];
?>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nip'); ?></label>
        <div class="col-md-6">       <?= $form->field($model, 'nip')->textInput(['maxlength' => true,'readOnly' => true ])->label(false); ?>
    </div>
    </div>


    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nama'); ?></label>
        <div class="col-md-6">        <?= $form->field($model, 'nama')->textInput(['maxlength' => true,'readOnly' => true])->label(false); ?>

    </div>
    </div>

    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('gaji_pokok'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'gaji_pokok')->textInput(['maxlength' => true])->label(false); ?>
        </div>
    </div>
    <div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('gaji_lembur'); ?></label>
        <div class="col-md-6">
            <?= $form->field($model, 'gaji_lembur')->textInput(['maxlength' => true])->label(false); ?>
        </div>
    </div>

    <?= Tabs::widget(['items' =>  $items ,'navType' =>'nav-pills']);  ?>

 
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
