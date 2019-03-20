<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$gridColumns = [['class' => 'yii\grid\SerialColumn'],
            'nama_level_jabatan',
            'kelas_level_jabatan',
            'nilai_jabatan',
            'ikkd',
             'tpp_dinamis',
             'tpp_statis',

         ['class' => 'yii\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
              'update', 'delete', 'view', ], $this->context->route)],    ];
/* @var $this yii\web\View */
/* @var $searchModel app\models\LevelJabatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Level Jabatan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="level-jabatan-index">
<?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,

        'striped' => false,

        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,

        'panel' => [
            'type' => GridView::TYPE_INFO,
           'heading' => '<i class="glyphicon glyphicon-tasks"></i>  <strong> '.Yii::t('app', 'Level Jabatan').'</strong>',
        ],
            'toolbar' => [
        ['content' => ((Mimin::checkRoute($this->context->id.'/create'))) ? Html::a(Yii::t('app', 'Level Jabatan Baru'), ['create'], ['class' => 'btn btn-success']) : ''],

        '{export}',
        '{toggleData}',
    ],

         'resizableColumns' => true,
    ]); ?>
    <?php Pjax::end(); ?>
</div>
