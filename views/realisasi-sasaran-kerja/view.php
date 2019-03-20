<?php

use yii\widgets\DetailView;
use  yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\RealisasiSasaranKerja */

$this->title = $model->id_realisasi;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Realisasi Sasaran Kerja'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realisasi-sasaran-kerja-view">

<?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->


        <div class="row">
        <label class="col-md-3 col-form-label">Keputusan</label>
        <div class="col-md-6">
            <?= $form->field($model, 'status_realisasi')->dropDownList(['Disetujui' => 'Disetujui', 'Ditolak' => 'Ditolak'], ['prompt' => 'Keputusan ... '])->label(false); ?>
        </div>
        
      </div>
      <div class="row">
        <label class="col-md-3 col-form-label">Kualitas Realisasi</label>
        <div class="col-md-6">
            <?= $form->field($model, 'kualitas_realisasi')->textInput()->label(false); ?>
        </div>
        
      </div>
    
        <div class="row">
        <div class="col-md-2">
        <?= Html::submitButton(Yii::t('app', 'Approve'), ['class' => 'btn btn-success']); ?>
    </div>
    </div>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'uraian_tugas',
            'bulan',
            'kuantitas_skp',
            'kuantitas',
            'satuan',
            [
                'attribute' => 'file_pendukung',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->file_pendukung, Url::to(['/document/'.$model->file_pendukung]));
                },
               ],
        ],
    ]); ?>

</div>
<?php ActiveForm::end(); ?>