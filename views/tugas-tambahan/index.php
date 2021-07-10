<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\grid\GridView;
use yii\widgets\Pjax;

$gridColumns = [['class' => 'yii\grid\SerialColumn'],
            'bulan',
            'tahun',
            'uraian_tugas:ntext',
            [
                'attribute' => 'file_pendukung',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->file_pendukung, Url::to(['/document/'.$model->file_pendukung]));
                },
               ],
    [
        'attribute' => 'Pegawai',
        'value' => function ($model) {
            return is_null($model->pegawai) ? "" : $model->pegawai->nama_lengkap;
        }
    ],
    [
        'attribute' => 'Penilai',
        'value' => function ($model) {
            return is_null($model->penilai) ? "" : $model->penilai->nama_lengkap;
        }
    ],

            // 'status',
            // 'id_pegawai',
            // 'id_penilai',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'options' => [],
                'value' => function ($data) {
                    if ($data->status == 'Diajukan') {
                        return "<span class='badge badge-pill badge-info'>Diajukan</span>";
                    } elseif ($data->status == 'Disetujui') {
                        return "<span class='badge badge-pill badge-success'>Disetujui</span>";
                    } elseif ($data->status == 'Ditolak') {
                        return "<span class='badge badge-pill badge-danger'>Ditolak</span>";
                    }
                },
            ],
                    // 'tahun',
        ];

/* @var $this yii\web\View */
/* @var $searchModel app\models\TugasTambahanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Tugas Tambahan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tugas-tambahan-index">

<div class="shift-index">
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body text-left">
                <?= Html::a('<i class="material-icons">add</i>'.Yii::t('app', 'Tugas Tambahan Baru'), ['create'], ['class' => 'btn btn-success']); ?>

                <?php

if (Yii::$app->user->identity->is_atasan) {
    echo Html::a('<i class="material-icons">gavel</i>'.Yii::t('app', 'Approve').(($jml > 0) ? '&nbsp;&nbsp; <span class="notification">'.$jml.'</span>' : ''), ['index-approve'], ['class' => 'btn btn-info']);
}
?>

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
