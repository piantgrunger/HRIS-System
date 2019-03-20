<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

$this->title = 'Login';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="utf-8">
        <link rel="apple-touch-icon" sizes="76x76" href="<?= Url::to('@web/Image/logo.png') ?>">
        <link rel="icon" type="image/png" href="<?= Url::to('@web/Image/logo.png') ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <title><?= Html::encode($this->title); ?></title>
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= Url::to('@web/creative/assets/css/material-dashboard.css?v=2.1.0') ?>">
        <link rel="stylesheet" href="<?= Url::to('@web/creative/assets/demo/demo.css') ?>">
    </head>
    <body class="off-canvas-sidebar">
        <?php $this->beginBody() ?>

        <?= $content ?>

        <?php $this->endBody() ?>
        <!--   Core JS Files   -->
        <script src="<?= Url::to('@web/creative/assets/js/core/jquery.min.js') ?>"></script>
        <script src="<?= Url::to('@web/creative/assets/js/core/popper.min.js') ?>"></script>
        <script src="<?= Url::to('@web/creative/assets/js/core/bootstrap-material-design.min.js') ?>"></script>
        <script src="<?= Url::to('@web/creative/assets/js/plugins/perfect-scrollbar.jquery.min.js') ?>"></script>
        <!-- Chartist JS -->
        <script src="<?= Url::to('@web/creative/assets/js/plugins/chartist.min.js') ?>"></script>
        <!--  Notifications Plugin    -->
        <script src="<?= Url::to('@web/creative/assets/js/plugins/bootstrap-notify.js') ?>"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="<?= Url::to('@web/creative/assets/js/material-dashboard.js?v=2.1.0') ?>" type="text/javascript"></script>
        <!-- Material Dashboard DEMO methods, don't include it in your project! -->
        <script src="<?= Url::to('@web/creative/assets/demo/demo.js') ?>"></script>

        <script src="<?= Url::to('@web/js/login.main.js') ?>"></script>
        <script>
            $(document).ready(function () {
                md.checkFullPageBackgroundImage();
                setTimeout(function () {
                    $('.card').removeClass('card-hidden');
                }, 700);
            });
        </script>
    </body>
</html>
<?php $this->endPage() ?>
