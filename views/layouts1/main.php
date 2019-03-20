
<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\widgets\Breadcrumbs;
use app\widgets\Alert;
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;

$path = Url::to(['/'], true);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/ico', 'href' => $path.'favicon.ico']);

AppAsset::register($this);


$js = <<< 'SCRIPT'

$('#modal').insertAfter($('body'));
$('body').on('click', function (e) {
        //did not click a popover toggle, or icon in popover toggle, or popover
        if ($(e.target).data('toggle') !== 'popover'
            && $(e.target).parents('[data-toggle="popover"]').length === 0
            && $(e.target).parents('.popover.in').length === 0) {
            $('[data-toggle="popover"]').popover('hide');
        }
    });
/* To initialize BS3 tooltips set this below */
$(function () {
    $("[data-toggle='tooltip']").tooltip();
});;
/* To initialize BS3 popovers set this below */
$(function () {
    $("[data-toggle='popover']").popover();
});
SCRIPT;
// Register tooltip/popover initialization javascript
$this->registerJs($js);

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
<body class="">
<?php $this->beginBody(); ?>
<div class="wrapper">
<?=$this->render('left.php'); ?>

<div class="main-panel">
<?=$this->render('header.php'); ?>
<div class="content">
			<div class="container-fluid">
            <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : '',
        ]); ?>
        		<?= Alert::widget(); ?>
				<?= $content; ?>
			</div>
		</div>

	<footer class="footer">
				<div class="copyright container-fluid" style ="margin-top : 20px;">
					<nav class="pull-left">
						<ul>
							<li>
								<a href="#">
									Pemerintah Kota HRIS
								</a>
							</li>
						</ul>
					</nav>
					<p class="copyright pull-right">
						&copy; <script>document.write(new Date().getFullYear())</script> HRIS System
					</p>
				</div>
			</footer>


</div>


</div>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
<?php
}  ?>