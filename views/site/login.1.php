<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->registerCSSfile(Url::to(['/css/stylelogin.css']));

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>",
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>",
];
?>
<div class="login-page">

<h1>Banjarbaru Begawi</h1>
<div class="main-agile">
		<div><span style="color:white; font-size:'8px';"></span></div>
		<div class="content-wthree">
		<img src="<?=Url::to(['/Image/logo.png']); ?>" width="65" heigth="70" alt=" ">
			<div class="about-middle">
			<section class="slider">
			<div class="flexslider">

		  </section>
		</div>

		<div class="new-account-form">
			<div id="pesan"></div>
			<br>
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
		<div class="clear"> </div>

		</div>
	</div>

</div><!-- /.login-box -->
</div>