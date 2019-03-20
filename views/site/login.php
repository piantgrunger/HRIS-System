<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group input-group'],
    'inputTemplate' => '<div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="material-icons">face</i>
                        </span>
                    </div>{input}',
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group input-group'],
    'inputTemplate' => '<div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">lock_outline</i>
                        </span>
                      </div>{input}',
];
?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="#">HRM System</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
              <div class="collapse navbar-collapse justify-content-end">
     
      </div>

    </div>
</nav>
<!-- End Navbar -->
<div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('<?= Url::to('@web/Image/'); ?>background.jpg'); background-size: cover; background-position: top center;">
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                    <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false, 'class' => 'sign-in-form']); ?>
                    <div class="card card-login card-hidden">
                        <div class="card-header card-header-rose text-center">
                            <h4 class="card-title">Login</h4>
                            <div class="social-line">
                              
                            </div>
                        </div>
                        <div class="card-body ">
                            <p class="card-description text-center">HRM System  </p>
                            <span class="bmd-form-group">
                                <?=
                                $form->field($model, 'username', $fieldOptions1)->label(false)
                                    ->input('text', ['placeholder' => $model->getAttributeLabel('username'), 'class' => 'form-control']);
                                ?>
                            </span>
                            <span class="bmd-form-group">
                                <?=
                                $form
                                    ->field($model, 'password', $fieldOptions2)
                                    ->label(false)
                                    ->passwordInput(['placeholder' => $model->getAttributeLabel('password'), 'class' => 'form-control']);
                                ?>
                            </span>
                        </div>
                        <div class="card-footer justify-content-center">
                            <?= Html::submitButton('Lets Work', ['class' => 'btn btn-rose btn-link btn-lg', 'name' => 'login-button']); ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <nav class="float-left">
                    <ul>
                        <li>
                            <a href="#">
                               &copy Phi Soft
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright float-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, HRM System.
                </div>
            </div>
        </footer>
    </div>
</div>