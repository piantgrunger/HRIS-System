<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;
use  yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SasaranKinerjaPegawai */

$this->title = $model->id_skp;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Sasaran Kinerja Pegawai'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sasaran-kinerja-pegawai-view">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->


        <div class="row">
        <label class="col-md-3 col-form-label">Keputusan</label>
        <div class="col-md-4">
            <?= $form->field($model, 'status_skp')->dropDownList(['Disetujui' => 'Disetujui', 'Ditolak' => 'Ditolak'], ['prompt' => 'Keputusan ... '])->label(false); ?>
        </div>
        <div class="col-md-2">
        <?= Html::submitButton(Yii::t('app', 'Approve'), ['class' => 'btn btn-success']); ?>
    </div>
    </div>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'uraian_tugas:ntext',
            'angka_kredit',
            'kuantitas',
            'satuan_kuantitas',
            'waktu',
            'satuan_waktu',
            'biaya',
            'tahun',
            'status_skp',
        ],
    ]) ?>

<div class="panel panel-primary"   >
<div class="panel-heading"> Detail SKP Bulanan

</div>


<table id="table-detail" class="table table-bordered table-hover kv-grid-table kv-table-wrap">
    <thead>
        <tr>
            <th>No.</th>
            <th width="50%">Bulan</th>
            <th>Kuantitas</th>
            <th>Satuan</th>

        </tr>
    </thead>
    <?= \mdm\widgets\TabularInput::widget([
        'id' => 'detail-grid',
        'allModels' => $model->detailSasaranKinerjaPegawai,
        'model' => \app\models\detsasarankinerjapegawai::className(),
        'tag' => 'tbody',
         'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_item_skp_view',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add2',
        ]

    ]);
    ?>
    </table>


</div>
</div>

    <?php ActiveForm::end(); ?>
