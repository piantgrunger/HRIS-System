<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use dmstr\widgets\Alert;

$gridColumns = [['class' => 'yii\grid\SerialColumn'],
 //           'id_pegawai',
   //         'id_penilai',
    [
        'attribute' => 'Nama Pegawai',
        'options' => [
            'width' => '120px',
        ],
        'value' => function ($model) {
            return $model->pegawai->nama_lengkap;
        },
    ],
    [
        'attribute' => 'Nama Penilai',
        'options' => [
            'width' => '120px',
        ],
        'value' => function ($model) {
            return $model->penilai->nama_lengkap;
        },
    ],
   'uraian_tugas',
            'angka_kredit',
             'kuantitas',
             'satuan_kuantitas',
             'waktu',
             'satuan_waktu',
             'biaya',

    [
        'attribute' => 'status_skp',
        'format' => 'raw',
        'options' => [],
        'value' => function ($data) {
            if ($data->status_skp == 'Diajukan') {
                return "<span class='badge badge-pill badge-info'>Diajukan</span>";
            } elseif ($data->status_skp == 'Disetujui') {
                return "<span class='badge badge-pill badge-success'>Disetujui</span>";
            } elseif ($data->status_skp == 'Ditolak') {
                return "<span class='badge badge-pill badge-danger'>Ditolak</span>";
            }
        },
    ],
            // 'tahun',

    [
        'class' => 'yii\grid\ActionColumn',
        'options' => [
            'width' => '120px',
        ],
        'contentOptions' => ['class' => 'td-actions text-right'],
        'headerOptions' => ['class' => 'text-right'],
         'template' => Mimin::filterActionColumn([
             'update',
        ], $this->context->route),
    ],
];

/* @var $this yii\web\View */
/* @var $searchModel app\models\SasaranKinerjaPegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Sasaran Kinerja Pegawai');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sasaran-kinerja-pegawai-index">

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body text-left">
                <?= Html::a('<i class="material-icons">add</i>'.Yii::t('app', 'SKP Baru'), ['create'], ['class' => 'btn btn-success']); ?>
                                <?php

                                if (Yii::$app->user->identity->is_atasan) {
                                    echo Html::a('<i class="material-icons">gavel</i>'.Yii::t('app', 'Approve').(($jmlSkp > 0) ? '&nbsp;&nbsp; <span class="notification">'.$jmlSkp.'</span>' : ''), ['index-approve'], ['class' => 'btn btn-info']);
                                }
                                ?>
                                                <?= Html::a('<i class="material-icons">print</i>' . Yii::t('app', 'Formulir Sasaran Kerja'), ['laporan'], ['class' => 'btn btn-primary']); ?>


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
<?= Alert::widget(); ?>

<?php echo $this->render('_search', ['model' => $searchModel]); ?>;

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
