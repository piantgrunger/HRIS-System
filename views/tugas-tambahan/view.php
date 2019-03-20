<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use  yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TugasTambahan */

$this->title = $model->id_tugas_tambahan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Tugas Tambahan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tugas-tambahan-view">

<?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->


        <div class="row">
        <label class="col-md-3 col-form-label">Keputusan</label>
        <div class="col-md-4">
            <?= $form->field($model, 'status')->dropDownList(['Disetujui' => 'Disetujui', 'Ditolak' => 'Ditolak'], ['prompt' => 'Keputusan ... '])->label(false); ?>
        </div>
        <div class="col-md-2">
        <?= Html::submitButton(Yii::t('app', 'Approve'), ['class' => 'btn btn-success']); ?>
    </div>
    </div>




    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'uraian_tugas:ntext',
            [
                'attribute' => 'file_pendukung',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->file_pendukung, Url::to(['/document/'.$model->file_pendukung]));
                },
               ],

            'status',
        ],
    ]); ?>

</div>
<?php ActiveForm::end(); ?>