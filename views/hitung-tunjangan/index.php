<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use dmstr\widgets\Alert;

$gridColumns = [['class' => 'yii\grid\SerialColumn'],
            'tgl_awal:date',
            'tgl_akhir:date',
//            'status_proses',
            'nama_satuan_kerja',
         ['class' => 'yii\grid\ActionColumn',
        'options' => [
            'width' => '120px',
        ],
        'contentOptions' => ['class' => 'td-actions text-right'],
        'headerOptions' => ['class' => 'text-right'],

         'template' => Mimin::filterActionColumn([
             'delete', 'view', ], $this->context->route).'  {print}  ',
             'buttons' => [
               'print' => function ($url, $model) {
                   if (Mimin::checkRoute($this->context->id.'/print')) {
                       return
                           Html::a(
                               '<i class="fa fa-print"></i>',
                               ['print', 'id' => $model->id_hitung_tunjangan],
                               [
                               'title' => Yii::t('app', 'Cetak'),
                               'data-pjax' => 0,
                               'class' => 'btn btn-primary btn-round',
                           ]
                       );
                   } else {
                       return ' ';
                   }
               },
           ],
           ],    ];

/* @var $this yii\web\View */
/* @var $searchModel app\models\HitungTunjanganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Hitung Tunjangan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hitung-tunjangan-index">

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body text-left">
                <?= Html::a('<i class="material-icons">add</i>'.Yii::t('app', 'Hitung Tunjangan Baru'), ['create'], ['class' => 'btn btn-success']); ?>
            </div>
        </div>
    </div>
     <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">money</i>
                </div>
                <h4 class="card-title"><?= $this->title; ?> </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
<?=Alert::widget()?>

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
