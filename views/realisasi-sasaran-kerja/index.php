<?php


use hscstudio\mimin\components\Mimin;
use app\widgets\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use dmstr\widgets\Alert;

$gridColumns = [['class' => 'yii\grid\SerialColumn'],
    [
        'attribute' => 'Pegawai',
        'value' => function ($model) {
            return is_null($model->skp) ? "" : $model->skp->pegawai->nama_lengkap;
        }
    ],
    [
        'attribute' => 'Penilai',
        'value' => function ($model) {
            return is_null($model->skp) ? "" : $model->skp->penilai->nama_lengkap;
        }
    ],
            'uraian_tugas',
            'bulan',
            'kuantitas_skp',
            'kuantitas',
            'satuan',
            [
             'attribute' => 'file_pendukung',
             'format' => 'raw',
             'value' => function ($model) {
                 return Html::a($model->file_pendukung, Url::to(['/document/'.$model->file_pendukung]));
             },
            ],
            [
                'attribute' => 'status_realisasi',
                'format' => 'raw',
                'options' => [],
                'value' => function ($data) {
                    if ($data->status_realisasi == 'Diajukan') {
                        return "<span class='badge badge-pill badge-info'>Diajukan</span>";
                    } elseif ($data->status_realisasi == 'Disetujui') {
                        return "<span class='badge badge-pill badge-success'>Disetujui</span>";
                    } elseif ($data->status_realisasi == 'Ditolak') {
                        return "<span class='badge badge-pill badge-danger'>Ditolak</span>";
                    }
                },
            ],
           'kualitas_realisasi',

         ['class' => 'app\widgets\grid\ActionColumn',
         'options' => [
             'width' => '120px',
         ],
         'contentOptions' => ['class' => 'td-actions text-right'],
         'headerOptions' => ['class' => 'text-right'],

         'template' => Mimin::filterActionColumn([
              'update', 'delete', 'view', ], $this->context->route), ],    ];

/* @var $this yii\web\View */
/* @var $searchModel app\models\RealisasiSasaranKerjaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Realisasi Sasaran Kerja');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realisasi-sasaran-kerja-index">

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body text-left">
                <?= Html::a('<i class="material-icons">add</i>'.Yii::t('app', 'Realisasi Baru'), ['create'], ['class' => 'btn btn-success']); ?>
                                <?php

                                if (Yii::$app->user->identity->is_atasan) {
                                    echo Html::a('<i class="material-icons">gavel</i>'.Yii::t('app', 'Approve').(($jmlRealisasi > 0) ? '&nbsp;&nbsp; <span class="notification">'.$jmlSkp.'</span>' : ''), ['index-approve'], ['class' => 'btn btn-info']);
                                }
                                ?>

            </div>
        </div>
    </div>
     <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">vertical_split</i>
                </div>
                <h4 class="card-title"><?= $this->title; ?> </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">



    <?php Pjax::begin(); ?>
<?= Alert::widget(); ?>



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
