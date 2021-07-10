<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use dmstr\widgets\Alert;
use app\widgets\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

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

$js = <<< 'SCRIPT'

$('body').on('click', function (e) {
        //did not click a popover toggle, or icon in popover toggle, or popover
        if ($(e.target).data('toggle') !== 'popover'
            && $(e.target).parents('[data-toggle="popover"]').length === 0
            && $(e.target).parents('.popover.in').length === 0) {
            $('[data-toggle="popover"]').popover('hide');
        }
    });
/* To initialize BS3 tooltips set this below */
$(function () {
    $("[data-toggle='tooltip']").tooltip();
});;
/* To initialize BS3 popovers set this below */
$(function () {
    $("[data-toggle='popover']").popover();
});
SCRIPT;
// Register tooltip/popover initialization javascript
$this->registerJs($js);

$gridColumns = [['class' => 'yii\grid\SerialColumn'],
  /*
'nip',
            'nik',
            'nama_lengkap',
     */
            //    'alamat',
    [
        'attribute' => 'Foto',
        'format' => 'html',
        'value' => function ($model) {
            if (is_null($model->foto)) {
                return '';
            } else {
                return Html::img(['/media/'.$model->foto], ['class' => 'rounded-circle', 'width' => '100', 'height' => '100']);
            }
        },
    ],
    [
        'attribute' => 'Nama Pegawai / NIP / TTL',
        'format' => 'raw',
        'headerOptions' => ['style' => 'width:30%'],
        'value' => function ($model) {
            return '<b>'.$model->nama_lengkap.'</b><br>'.$model->nip.'<br>'.$model->tempat_lahir.' , '.Yii::$app->formatter->asDate($model->tanggal_lahir);
        },
    ],
    [
        'attribute' => 'nama_jabatan',
        'format' => 'raw',
        'value' => function ($model) {
            return  $model->nama_jabatan.$model->eselon;
        },
        'headerOptions' => ['style' => 'width:20%'],
    ],

    [
        'attribute' => 'nama_satuan_kerja',
      //  'filter' => $dataSatuanKerja
    ],
/*
    [
        'attribute' => 'Act',
            'format' => 'raw',
        'headerOptions' => ['style' => 'width:15%'],

        'value' => function ($model) {
            return Html::tag('label', '<i class="fa fa-cog" aria-hidden="true"></i>', [
                'data-toggle' => 'popover',
                'data-trigger' => 'click focus',
                'data-placement' => 'bottom',
                'data-html' => 'true',    // allow html tags
                'class' => 'btn btn-primary',
         // 'data-title'=> 'Help',
                'data-content' => Html::a(Yii::t('app', '<i class="fa fa-eye" aria-hidden="true"></i> Detail Pegawai'), Url::to(['view', 'id' => $model->id_pegawai]), ['data-toggle' =>"modal","data-target"=>"#modal", 'class' => 'popupModal' , 'id' => 'href'.$model->id_pegawai,]) .
                "<hr>".Html::a(Yii::t('app', '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah Data Pegawai'), ['update', 'id' => $model->id_pegawai]) ."<HR>". Html::a(Yii::t('app', '<i class="fa fa-eraser" aria-hidden="true"></i>  Hapus Data Pegawai'), ['delete', 'id' => $model->id_pegawai], [
                    'data' => [
                        'confirm' => Yii::t('app', 'Apakah Anda yakin ingin menghapus item ini??'),
                        'method' => 'post',
                    ],
                ]),
              //  'style' => 'border-bottom: 1px dashed #888; cursor:help;'
            ]);
        }


    ]
    */
    'kode_checklog',
          // 'jenis_kelamin',
            // 'tempat_lahir',
            // 'tanggal_lahir',
      ];
/*
      if (Yii::$app->requestedRoute !== 'pegawai/index') {
     $gridColumns[] =

      [
         'attribute' => 'Foto',
         'format' => 'html',
         'value' => function ($model) {
             if (is_null($model->foto)) {
                 return '';
             } else {
                 return Html::img(['/media/'.$model->foto], ['class' => 'img-circle', 'width' => '100']);
             }
         },
        ];
 }
*/

      $gridColumns[] = ['class' => 'app\widgets\grid\ActionColumn',
    'options' => [
        'width' => '120px',
    ],
    'contentOptions' => ['class' => 'td-actions text-right'],
    'headerOptions' => ['class' => 'text-right'],

      'template' => Mimin::filterActionColumn([
        'update',  ], $this->context->route).' {hapus} {lihat} {checklog} {upload}',
    'buttons' => [
        'hapus' => function ($url, $model) {
            if (Mimin::checkRoute($this->context->id . '/delete')) {
                return
                    Html::a(
                        Yii::t('app', '<i class="fa fa-remove" aria-hidden="true"></i> '),
                        Url::to(['delete', 'id' => $model->id_pegawai]),
                        [
                        'data-toggle' => 'modal', 'data-target' => '#modal', 'class' => 'popupModal', 'id' => 'href' . $model->id_pegawai,
                        'title' => 'Hapus', 'class' => 'btn btn-danger btn-round',
                    ]
                );
            } else {
                return ' ';
            }
        },
        'lihat' => function ($url, $model) {
            if (Mimin::checkRoute($this->context->id.'/view')) {
                return
                    Html::a(
                        Yii::t('app', '<i class="fa fa-eye" aria-hidden="true"></i> '),
                        Url::to(['view', 'id' => $model->id_pegawai]),
                        ['data-toggle' => 'modal', 'data-target' => '#modal', 'class' => 'popupModal', 'id' => 'href'.$model->id_pegawai,
                     'title' => 'Lihat', 'class' => 'btn btn-info btn-round',
                     ]
                    );
            } else {
                return ' ';
            }
        }, 'checklog' => function ($url, $model) {
            if (Mimin::checkRoute($this->context->id.'/update-kode-checklog')) {
                return
                    Html::a(
                        Yii::t('app', '<i class="fa fa-clock-o" aria-hidden="true"></i> '),
                        Url::to(['update-kode-checklog', 'id' => $model->id_pegawai]),
                        [
                        'data-toggle' => 'modal', 'data-target' => '#modal', 'class' => 'popupModal', 'id' => 'href1'.$model->id_pegawai,
                        'title' => 'ubah', 'class' => 'btn btn-info btn-round',
                    ]
                );
            } else {
                return ' ';
            }
        }, 'upload' => function ($url, $model) {
            if (Mimin::checkRoute($this->context->id . '/upload-kelengkapan')) {
                return
                    Html::a(
                        Yii::t('app', '<i class="fa fa-file-archive-o" aria-hidden="true"></i> '),
                        Url::to(['upload-kelengkapan', 'id' => $model->id_pegawai]),
                        [
                        'data-toggle' => 'modal', 'data-target' => '#modal', 'class' => 'popupModal', 'id' => 'href1' . $model->id_pegawai,
                        'title' => 'ubah', 'class' => 'btn btn-info btn-round',
                    ]
                );
            } else {
                return ' ';
            }
        },
    ],
    ];

/* @var $this yii\web\View */
/* @var $searchModel app\models\PegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Pegawai');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-index">
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body text-left">
                <?php
                if (Mimin::checkRoute($this->context->id . '/create')) {
                    echo Html::a('<i class="material-icons">add</i>'.Yii::t('app', 'Pegawai Baru'), ['create'], ['class' => 'btn btn-success']);
                }
                ?>
            </div>
        </div>
    </div>
     <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">people</i>
                </div>
                <h4 class="card-title"><?= $this->title; ?> </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">


    <?php Pjax::begin(); ?>
<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
     <?= Alert::widget(); // echo $this->render('_search', ['model' => $searchModel]);?>;

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
  //          'filterModel' => $searchModel,
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
       'header' => '<h4>Detail Pegawai</h4>',
       'size' => 'modal-lg',
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
 <?php Modal::end(); ?>
