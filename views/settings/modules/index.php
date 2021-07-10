<?php

use yii\helpers\Html;
use dmstr\widgets\Alert;use app\widgets\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\settings\ModulesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Modules');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body text-left">
                <?= Html::a('<i class="material-icons">add</i>' . Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title"><?= $this->title ?> <small>Listing</small></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'summary' => '',
                        'columns' => [
                            'name',
                            'label',
                            'url',
                            'fa_icon',
                            [
                                'class' => 'app\widgets\grid\ActionColumn',
                                'header' => "Actions",
                                'options' => [
                                    'width' => '120px',
                                ],
                                'template' => '{view}{update}{delete}',
                                'contentOptions' => ['class' => 'td-actions text-right'],
                                'headerOptions' => ['class' => 'text-right']
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php Pjax::end(); ?>
