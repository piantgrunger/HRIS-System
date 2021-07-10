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
                return Html::img(['/media/' . $model->foto], ['class' => 'rounded-circle', 'width' => '100', 'height' => '100']);
            }
        },
    ],
    [
        'attribute' => 'Nama Pegawai / NIP / TTL',
        'format' => 'raw',
        'headerOptions' => ['style' => 'width:30%'],
        'value' => function ($model) {
            return '<b>' . $model->nama_lengkap . '</b><br>' . $model->nip . '<br>' . $model->tempat_lahir . ' , ' . Yii::$app->formatter->asDate($model->tanggal_lahir);
        },
    ],
    [
        'attribute' => 'nama_jabatan',
        'format' => 'raw',
        'value' => function ($model) {
            return  $model->nama_jabatan . $model->eselon;
        },
        'headerOptions' => ['style' => 'width:20%'],
    ],

    [
        'attribute' => 'nama_satuan_kerja',
      //  'filter' => $dataSatuanKerja
    ],
    'gaji_pokok:decimal',
    'gaji_lembur:decimal',
  
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
        'update',  ], $this->context->route),
      ];

/* @var $this yii\web\View */
/* @var $searchModel app\models\PegawaiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

      $this->title = Yii::t('app', 'Daftar Payroll');
      $this->params['breadcrumbs'][] = $this->title;
        ?>
<div class="pegawai-index">
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body text-left">
           
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
