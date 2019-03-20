<?php
use yii\helpers\Html;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use yii\helpers\Url;

$this->registerCSSfile(Url::to(['/css/stylelogin.css']));

AppAsset::register($this);

/* @var $this \yii\web\View */
/* @var $content string */
$this->title = 'HRIS System';

?>
<?php $this->beginPage(); ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">
<head>
    <meta charset="<?= Yii::$app->charset; ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags(); ?>
    <title><?= Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
</head>
<body class="login-page">
<?php $this->beginBody(); ?>
<?php

NavBar::begin([
      'brandLabel' => '<h4><p id="text-light"> <b>  HRIS Berbasis Kinerja Pegawai </b> </p></h4>',
       'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar  navbar-transparent  fixed-top ',
    ],
    'innerContainerOptions' => [
        'class' => 'container',
    ],
]);

NavBar::end();

?>




    <?= $content; ?>




<?php $this->endBody(); ?>

</body>
</html>
<?php $this->endPage(); ?>
