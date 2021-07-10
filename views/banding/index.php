<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use dmstr\widgets\Alert;
use app\widgets\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$this->registerCss('.notification
{position: absolute;
top: 5px;
border: 1px solid #FFF;
right: 10px;
font-size: 9px;
background: #f44336;
color: #FFFFFF;
min-width: 20px;
padding: 0px 5px;
height: 20px;
border-radius: 10px;
text-align: center;
line-height: 19px;
vertical-align: middle;
display: block;}');

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

         'template' => Mimin::filterActionColumn([
              'update', 'delete', 'view', ], $this->context->route),    ],    ];

/* @var $this yii\web\View */
/* @var $searchModel app\models\BandingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Pembelaan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banding-index">

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body text-left">
                <?= Html::a('<i class="material-icons">add</i>'.Yii::t('app', 'Pembelaan Baru'), ['create'], ['class' => 'btn btn-success']); ?>
                <?php
                if (Yii::$app->user->identity->is_atasan) {
                    echo Html::a('<i class="material-icons">gavel</i>'.Yii::t('app', 'Approve').(($jmlBanding > 0) ? '&nbsp;&nbsp; <span class="notification">'.$jmlBanding.'</span>' : ''), ['index-approve'], ['class' => 'btn btn-info']);
                }
                ?>
         
            </div>
        </div>
    </div>
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
