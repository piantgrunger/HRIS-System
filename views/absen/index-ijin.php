<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use dmstr\widgets\Alert;
use yii\grid\GridView;
use yii\widgets\Pjax;

$gridColumns = [['class' => 'yii\grid\SerialColumn'],
            'nama_jenis_absen',
           'nip',
            'nama_pegawai',
            'tgl_absen:date',
            'masuk_kerja:time',
             'pulang_kerja:time',
             'terlambat_kerja',
             'pulang_awal',
             'alasan:ntext',

        //         'total_jam_potong',

         ['class' => 'yii\grid\ActionColumn',
        'options' => [
            'width' => '120px',
        ],
        'contentOptions' => ['class' => 'td-actions text-right'],
        'headerOptions' => ['class' => 'text-right'],

         'template' => Mimin::filterActionColumn([
              'update', 'delete', 'view', ], $this->context->route), ],    ];

/* @var $this yii\web\View */
/* @var $searchModel app\models\AbsenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Absen');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="absen-index">

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body text-left">
                <?= Html::a('<i class="material-icons">add</i>'.Yii::t('app', 'Absen Baru'), ['create'], ['class' => 'btn btn-success']); ?>
                <?= Html::a('<i class="material-icons">add</i>'.Yii::t('app', 'Ijin / Cuti '), ['create-ijin'], ['class' => 'btn btn-primary']); ?>
                <?= Html::a('<i class="material-icons">add</i>' . Yii::t('app', 'Ijin Terlambat'), ['create-terlambat'], ['class' => 'btn btn-rose']); ?>
                 <?= Html::a('<i class="material-icons">add</i>' . Yii::t('app', 'Pulang Awal'), ['create-pulang-awal'], ['class' => 'btn btn-info']); ?>

            </div>
        </div>
    </div>
     <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">calendar_today</i>
                </div>
                <h4 class="card-title"><?= $this->title; ?> </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">



    <?php Pjax::begin(); ?>
<?= Alert::widget(); // echo $this->render('_search', ['model' => $searchModel]);?>;

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