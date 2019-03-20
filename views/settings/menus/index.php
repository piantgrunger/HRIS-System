<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\LAHelper;
use yii\helpers\Url;
use app\models\settings\Modules;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\settings\MenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Menu Editor');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.css', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerCssFile('@web/css/menueditor.css?v=' . date('YmdHis'), ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                    <h4 class="card-title"><?= $this->title ?></h4>
                </div>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-4">
                        <div id="tab-modules">
                            <?php $modules = Modules::find()->orderBy('id ASC')->all(); ?>
                            <ul>
                                <?php foreach ($modules as $module): ?>
                                    <li><i class="material-icons"><?= $module->fa_icon ?></i> <?= $module->label ?> <a module_id="<?= $module->id ?>" class="addModuleMenu pull-right"><i class="fa fa-plus"></i></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="dd" id="menu-nestable">
                            <ol class="dd-list">
                                <?php foreach ($menus as $key): ?>
                                    <?php echo LAHelper::print_menu_editor($key); ?>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var ajaxMenuUrl = '<?= Url::to(['settings/menus/ajax']); ?>';
    var insertMenuUrl = '<?= Url::to(['settings/menus/insert']); ?>';
</script>
<?= $this->registerJsFile('@web/js/menueditor.js?v=' . date('YmdHis'), ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?= $this->registerJsFile('@web/creative/bower_components/Nestable/jquery.nestable.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>