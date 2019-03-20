<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h3><?= Html::encode($this->title); ?></h3>


    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->

            <?= $form->field($model, 'old_password')->passwordInput()->label('Password Lama'); ?>


                <?= $form->field($model, 'password')->passwordInput()->label('Password Baru'); ?>
               <?= $form->field($model, 'repeat_password')->passwordInput()->label('Ulang Password Baru'); ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']); ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
