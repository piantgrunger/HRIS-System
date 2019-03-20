<?php

use yii\helpers\Html;
use dmstr\widgets\Alert;use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\settings\RolesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Roles');
?>
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
                        'summary' => false,
                        'columns' => [
                            'id',
                            'name',
                            'display_name',
                            'description',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => "Actions",
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