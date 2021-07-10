<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use app\widgets\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$gridColumns=[['class' => 'yii\grid\SerialColumn'],
            'bulan',
            'tahun',
            'orientasi_pelayanan',
            'integritas',
            'komitmen',
            'disiplin',
            'kerjasama',
            'kepemimpinan',
            'jumlah',
            'rata_rata',
            'status',
            [
                'attribute' =>'Pegawai',
                'value' =>  function ($model) {
                    return is_null($model->pegawai)?"":$model->pegawai->nama_lengkap;
                }
            ],
    [
        'attribute' => 'Penilai',
        'value' => function ($model) {
            return is_null($model->penilai) ? "" : $model->penilai->nama_lengkap;
        }
    ],
            // 'id_pegawai',
            // 'id_penilai',

    [
        'class' => 'app\widgets\grid\ActionColumn',
        'options' => [
            'width' => '120px',
        ],
        'contentOptions' => ['class' => 'td-actions text-right'],
        'headerOptions' => ['class' => 'text-right'],
        'template' => Mimin::filterActionColumn([
            'update','delete',
        ], $this->context->route),
    ],
];


/* @var $this yii\web\View */
/* @var $searchModel app\models\PenilaianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Penilaian');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-index">

<div class="shift-index">
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body text-left">
                <?= Html::a('<i class="material-icons">add</i>' . Yii::t('app', 'Penilaian Baru'), ['create'], ['class' => 'btn btn-success']); ?>


            </div>
        </div>
    </div>
     <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">work</i>
                </div>
                <h4 class="card-title"><?= $this->title; ?> </h4>
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
