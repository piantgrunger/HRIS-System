<?php

    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

    /* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group'],
    'inputTemplate' => ' <span class="input-group-text"><i class="material-icons">face</i>{input}</span>',
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group'],
    'inputTemplate' => '<span class="input-group-text"><i class="material-icons">lock_outline</i>{input}</span>',
];
?>
<div class="login-page">


 <div class="row">
    <div class="Absolute-Center is-Responsive">
         <div class="col-sm-12 col-md-12 col-md-offset-1">
             <div class="card card-login" style="width: 100%;">
                 <div class="card-header card-header-rose ">  <h3 class="card-title text-center"> Banjarbaru Begawi </h3></div>
                 <div class="card-body">
                 <p class="card-description text-center">Silahkan Login </p>
                 <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
                 <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->
        <?= $form
                 ->field($model, 'username', $fieldOptions1)
    ->label(false)
    ->textInput(['placeholder' => $model->getAttributeLabel('username')]); ?>

<?= $form
    ->field($model, 'password', $fieldOptions2)
    ->label(false)
    ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]); ?>

<div class="row">
    <div class="col-xs-8">
        <?= $form->field($model, 'rememberMe')->checkbox(); ?>

               </div>


</div>
<?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']); ?>


<?php ActiveForm::end(); ?>

                 </div>


             </div>
</div>
</div>
</div>

</div>
