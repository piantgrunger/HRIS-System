<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use dmstr\widgets\Alert;use app\widgets\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$gridColumns=[['class' => 'yii\grid\SerialColumn'],
            'id_pegawai',
            'id_jabatan',
            'nama_jabatan',
            'unit_kerja',
             'tmt:date',
            // 'no_sk',
            // 'pejabat',

         ['class' => 'app\widgets\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
              'update','delete','view'], $this->context->route),    ],    ];


/* @var $this yii\web\View */
/* @var $searchModel app\models\RiwayatJabatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Riwayat Jabatan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="riwayat-jabatan-index">

    <?php Pjax::begin(); ?>
<?= Alert::widget()// echo $this->render('_search', ['model' => $searchModel]);?>;

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]);
 ?>
    <?php Pjax::end(); ?>
</div>
