<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use app\models\SatuanKerja;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Pegawai;

$dataPegawai = ArrayHelper::map(
    Pegawai::find()
        ->select(["id" => "id_pegawai", "nama" => "concat(nip,' - ',nama)"])
        ->asArray()
        ->all(),
    'id',
    'nama'
);

$dataSatuanKerja = ArrayHelper::map(
    SatuanKerja::find()
        ->select(['id' => 'id_satuan_kerja', 'nama' => 'nama_satuan_kerja'])
        ->asArray()
        ->all(),
    'id',
    'nama'
);
/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
    'pluginOptions' => [
        'onText' => 'Active',
        'offText' => 'Banned',
    ]
]) ?>



	<?php if (!$model->isNewRecord) {
    ?>
		<strong> Leave blank if not change password</strong>
		<div class="ui divider"></div>
		<?= $form->field($model, 'new_password') ?>
		<?= $form->field($model, 'repeat_password') ?>
		<?= $form->field($model, 'old_password') ?>
	<?php
} ?>

    <?= $form->field($model, 'id_satuan_kerja')->widget(Select2::className(), [
        'data' => $dataSatuanKerja,
        'options' => ['placeholder' => 'Pilih Satuan Kerja...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>
  <?= $form->field($model, 'id_pegawai')->widget(Select2::className(), [
        'data' => $dataPegawai,
        'options' => ['placeholder' => 'Pilih Pegawai...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
