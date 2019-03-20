
<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\widgets\Alert;
use app\assets\AppAsset;
use yii\helpers\Url;

$path = Url::to(['/'], true);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/ico', 'href' => $path.'favicon.ico']);

AppAsset::register($this);
//dmstr\web\AdminLteAsset::register($this);

if (Yii::$app->controller->action->id === 'login') {
    /**
     * Do not use this code in your template. Remove it.
     * Instead, use the code  $this->layout = '//main-login'; in your controller.
     */
    echo $this->render(
            'main-login',
            ['content' => $content]
        );
} else {
    $this->title = 'HRIS System'; ?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">
<head>
    <meta charset="<?= Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags(); ?>
    <title><?= Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
</head>
<body>

<?php $this->beginBody(); ?>

 <?=$this->render('header.php'); ?>



    <div class="container">



        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]); ?>
		<?= Alert::widget(); ?>
        <?= $content; ?>
    </div>
</div>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
<?php
}  ?>