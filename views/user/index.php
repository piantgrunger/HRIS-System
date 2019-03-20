<?php

use yii\helpers\Html;
use dmstr\widgets\Alert;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body text-left">
                <?= Html::a('<i class="material-icons">add</i>' . Yii::t('app', 'User Baru'), ['create'], ['class' => 'btn btn-success ']) ?>
                <?= Html::a('<i class="material-icons">print</i>' . Yii::t('app', 'Export User'), ['export'], ['class' => 'btn btn-primary ']) ?>

            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title"><?= $this->title ?> </h4>
            </div>
            <div class="card-body">
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,


                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'username',
                        'nama_pegawai',
                        'email:email',
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'options' => [
                            ],
                            'value' => function ($data) {
                                if ($data->status == 10) {
                                    return "<span class='badge badge-pill badge-success'>Active</span>";
                                } else {
                                    return "<span class='badge badge-pill badge-danger'>Baned</span>";
                                }
                            }
                        ],
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
