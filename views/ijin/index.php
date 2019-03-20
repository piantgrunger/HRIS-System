<?php

    $this->registerJs('

    $(document).ready(function(){
    $(\'#MyButton\').click(function(){

        var HotId = $(\'#w4\').yiiGridView(\'getSelectedRows\');
          $.ajax({
            type: \'POST\',
            url : \'multiple-delete\',
            data : {row_id: HotId},
            success : function() {
              $(this).closest(\'tr\').remove(); //or whatever html you use for displaying rows
            }
        });

    });
    });', \yii\web\View::POS_READY);


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$gridColumns=[['class' => 'yii\grid\SerialColumn'],
          [    'class' =>'yii\grid\CheckboxColumn'],
           'nama_jenis_absen',
           'nip',
            'nama_pegawai',
            'tgl_absen:date',
             'alasan:ntext',
             [
               'attribute' =>'File Pendukung',
               'format' => 'raw',
               'value' => function ($model) {
                   return ($model->file_pendukung!=="" &&  $model->file_pendukung!==null)?
                              Html::a("Download", ["media/".$model->file_pendukung], ["data-pjax"=>0]) :"";
               }
            ],
            [
                'attribute' => 'Status Validasi',
            'format' => 'raw',
        'value' => function ($data) {
            if ($data->status =='Sudah Divalidasi') {
                return Html::a(
                    "<span class='badge badge-pill badge-success'>Sudah Divalidasi</span>",
                    ["batal-validasi", "id" => $data->id_ijin ],
                    [
                        'title' => 'Batal Validasi',
                        'data' => [
                            'confirm' => Yii::t('app', 'Apakah anda yakin akan membatalkan validasi ijin ini??'),

                        ],
                    ]
                );
            } else {
                # code...
                return Html::a(
                    "<span class='badge badge-pill badge-danger'>Belum Divalidasi</span>",
                    ["validasi", "id" => $data->id_ijin],
                    ['title' => 'Validasi' ,
                        'data' => [
                            'confirm' => Yii::t('app', 'Apakah anda yakin akan memvalidasi ijin ini??'),

                        ],
                   ]
               );
            }
        },

            ]     ,
                     ['class' => 'yii\grid\ActionColumn',
        'options' => [
            'width' => '120px',
        ],
        'contentOptions' => ['class' => 'td-actions text-right'],
        'headerOptions' => ['class' => 'text-right'],

         'template' => Mimin::filterActionColumn([
               'delete'

            ], $this->context->route)],
             // 'alasan:ntext',
            // 'file_pendukung',
            // 'status'\
            ];


/* @var $this yii\web\View */
/* @var $searchModel app\models\IjinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Ijin');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ijin-index">

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'id' =>'w4'

    ]);
 ?>
    <?php Pjax::end(); ?>

    <?=Html::button("Hapus Data yang Dipilih", ["class"=>"btn btn-danger" , "id"=>"MyButton" ,"data" =>["confirm" =>"Apakah anda yakin akan menghapus data yang dipilih?"]])?>
</div>
