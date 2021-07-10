<?php


use dmstr\widgets\Alert;
use app\widgets\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Html;
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

$gridColumns = [['class' => 'yii\grid\SerialColumn'],
            'tgl_banding:date',
            'nama_pegawai',
            'nama_atasan',
            'ket',
             'alasan:ntext',
            // 'file',
             'status_banding',

         ['class' => 'app\widgets\grid\ActionColumn',
        'contentOptions' => ['class' => 'td-actions text-right'],
        'headerOptions' => ['class' => 'text-right'],
         'template' => '{lihat}',   'buttons' => [
            'lihat' => function ($url, $model) {
                return  Html::a(
                    Yii::t('app', '<i class="fa fa-pencil" aria-hidden="true"></i> '),
                    Url::to(['approve', 'id' => $model->id_banding]),
                    ['data-toggle' => 'modal', 'data-target' => '#modal', 'class' => 'popupModal', 'id' => 'href'.$model->id_banding,
                         'title' => 'Approve', 'class' => 'btn btn-info btn-round',
                         ]
                        );
            }, ],  ],    ];

/* @var $this yii\web\View */
/* @var $searchModel app\models\BandingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Pembelaan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banding-index">

<div class="row">

     <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">touch_app</i>
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

<?php

Modal::begin([
    'id' => 'modal',
       'header' => '<h4>Approve Pembelaan</h4>',
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
