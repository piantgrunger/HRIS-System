<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    'nip',
    'nama_pegawai',
    'tanggal_awal:date',
    'tanggal_akhir:date',
    'keterangan:ntext',

    [
        'class' => 'yii\grid\ActionColumn',
        'options' => [
            'width' => '120px',
        ],
        'contentOptions' => ['class' => 'td-actions text-right'],
        'headerOptions' => ['class' => 'text-right'],

        'template' => Mimin::filterActionColumn([
            'update', 'delete', 'view',
        ], $this->context->route),
    ],
];


/* @var $this yii\web\View */
/* @var $searchModel app\models\SkorsingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Skorsing');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="skorsing-index">

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body text-left">
                    <?= Html::a('<i class="material-icons">add</i>' . Yii::t('app', 'Skorsing Baru'), ['create'], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">gavel</i>
                    </div>
                    <h4 class="card-title"><?= $this->title ?> </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">


                        <?php Pjax::begin(); ?>

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => $gridColumns,


                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php Pjax::end(); ?>


</div>