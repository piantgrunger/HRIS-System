<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Shift */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shift-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->
<div class="row">
        <label class="col-md-3 col-form-label"><?= $model->getAttributeLabel('nama_satuan_kerja') ?></label>
        <div class="col-md-6">

    <?= $form->field($model, 'nama_shift')->textInput(['maxlength' => true])->label(false); ?>
        </div>
    </div>


<div class="panel panel-success"   >
<div class="panel-heading"> Data Shift

</div>
<table class="table">
    <thead>
        <tr>

            <th>Hari</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>

            <th><a id="btn-add2" href="#"><span class="glyphicon glyphicon-plus"></span></a></th>
        </tr>
    </thead>
    <?= \mdm\widgets\TabularInput::widget([
        'id' => 'detail-grid',
        'allModels' => $model->listDetShift,
        'model' => \app\models\DetShift::className(),
        'tag' => 'tbody',
        'form' => $form,
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_item_shift',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add2',
        ]
    ]);
    ?>
    </table>
    </div>
<div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
