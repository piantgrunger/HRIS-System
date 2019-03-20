<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use dmstr\widgets\Alert;
use yii\grid\GridView;
use yii\widgets\Pjax;

$gridColumns = [['class' => 'yii\grid\SerialColumn'],
            'periode',
            'tgl_absen_terakhir:date',
            [
                'attribute' => 'Status Validasi',
            'format' => 'raw',
        'value' => function ($data) {
            if ($data->status_validasi) {
                return Html::a(
                    "<span class='badge badge-pill badge-success'>Sudah Divalidasi</span>",
                    ["batal-validasi", "id" => $data->id_satuan_kerja ,'periode' => $data->periode ],
                    [
                        'title' => 'Batal Validasi',
                        'data' => [
                            'confirm' => Yii::t('app', 'Apakah anda yakin akan membatalkan validasi satuan kerja ini??'),

                        ],
                    ]
                );
            } else {
                # code...
                return Html::a(
                    "<span class='badge badge-pill badge-danger'>Belum Divalidasi</span>",
                    ["validasi", "id" => $data->id_satuan_kerja, 'periode' => $data->periode],
                    ['title' => 'Validasi' ,
                        'data' => [
                            'confirm' => Yii::t('app', 'Apakah anda yakin akan memvalidasi satuan kerja ini??'),

                        ],
                   ]
               );
            }
        },

            ]
    ];
/* @var $this yii\web\View */
/* @var $searchModel app\models\SatuanKerjaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Validasi Satuan Kerja');
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
