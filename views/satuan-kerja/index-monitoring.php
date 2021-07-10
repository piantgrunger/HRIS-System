<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use dmstr\widgets\Alert;
use app\widgets\grid\GridView;
use yii\widgets\Pjax;
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


$gridColumns = [['class' => 'yii\grid\SerialColumn'],
            'nama_satuan_kerja',
            [
                'attribute' => 'Validasi',
            'format' => 'raw',
        'value' => function ($data) {
            return Html::a(
                "Validasi",
                ["index-validasi", "id" => $data->id_satuan_kerja],
                [
                        'title' => 'Validasi',
                            'class' => 'btn btn-info btn-round',
                            'data-toggle' => 'modal', 'data-target' => '#modal', 'class' => 'popupModal', 'id' => 'href' . $data->id_satuan_kerja,



                    ]
                );
        }


            ]
    ];
/* @var $this yii\web\View */
/* @var $searchModel app\models\SatuanKerjaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Monitoring Satuan Kerja');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="satuan-kerja-index">
<div class="row">
     <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">account_balance</i>
                </div>
                <h4 class="card-title"><?= $this->title ?> </h4>
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
<?php
Modal::begin([
    'id' => 'modal',
    'header' => '<h4>Validasi Satuan Kerja</h4>',
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
