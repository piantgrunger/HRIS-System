<?php

use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use dmstr\widgets\Alert;
use yii\bootstrap\Modal;

$this->registerCss('
/* Important part */
.modal-dialog{
    overflow-y: initial !important
}
.modal-body{
    height: 500px;
    overflow-y: auto;
}');

$js = <<<JS

$('#modal').insertAfter($('body'));
  $("#modal").on("shown.bs.modal",function(event){
       var button = $(event.relatedTarget);
       var href = button.attr("href");
       $.pjax.reload("#pjax-modal",{
                 "timeout" : false,
                 "url" :href,
                 "replace" :false,
       });
  });

JS;
$this->registerJs($js);

$gridColumns=[['class' => 'yii\grid\SerialColumn'],
 //           'id_pegawai',
   //         'id_penilai',
    [
        'attribute' => 'Nama Pegawai',
        'options' => [
            'width' => '120px',
        ],
        'value' => function ($model) {
            return $model->pegawai->nama_lengkap;
        }

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
        }
    ],
            // 'tahun',

    [
        'class' => 'app\widgets\grid\ActionColumn',
        'options' => [
            'width' => '120px',
        ],
        'contentOptions' => ['class' => 'td-actions text-right'],
        'headerOptions' => ['class' => 'text-right'],
        'template' => '{lihat}', 'buttons' => [
            'lihat' => function ($url, $model) {
                if ($model->status_skp == 'Diajukan') {
                    return Html::a(
                        Yii::t('app', '<i class="fa fa-pencil" aria-hidden="true"></i> '),
                        Url::to(['approve', 'id' => $model->id_skp]),
                        [
                            'data-toggle' => 'modal', 'data-target' => '#modal', 'class' => 'popupModal', 'id' => 'href' . $model->id_skp,
                            'title' => 'Approve', 'class' => 'btn btn-info btn-round',
                        ]
                    );
                }
            },
        ],
    ],
];

/* @var $this yii\web\View */
/* @var $searchModel app\models\SasaranKinerjaPegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Sasaran Kinerja Pegawai');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sasaran-kinerja-pegawai-index">

     <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">work</i>
                </div>
                <h4 class="card-title"><?= $this->title ?> </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">



    <?php Pjax::begin(); ?>
<?= Alert::widget() ?>

<?php echo $this->render('_search', ['model' => $searchModel]);?>;

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
<?php

Modal::begin([
    'id' => 'modal',
    'header' => '<h4>Approve SKP</h4>',
    'size' =>'modal-lg'
]);

Pjax::begin(
    [
        'id' => 'pjax-modal', 'timeout' => 'false',
        'enablePushState' => 'false',
        'enableReplaceState' => 'false',
    ]
);
Pjax::end();
?>
 <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
<?php Modal::end(); ?>
