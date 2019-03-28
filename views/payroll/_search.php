<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PegawaiSearch */
/* @var $form yii\widgets\ActiveForm */
?>



    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
<div class="row"><div class="col-md-2">

    <?= $form->field($model, 'dataShown')->dropDownList([20 => 20, 50 => 50, 100 => 100, 200 => 200], ['placeholder' => 'Data ...' , 'onchange' => 'this.form.submit()'])->label(false) ?>

</div>
<div class="col-md-10">
    <?= $form->field($model, 'searchWord')->textInput(['placeholder' =>'Search ...'])->label(false) ?>
</div>
    <?php ActiveForm::end(); ?>
</div>
