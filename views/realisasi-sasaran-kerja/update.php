<?php


/* @var $this yii\web\View */
/* @var $model app\models\RealisasiSasaranKerja */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Realisasi Sasaran Kerja',
]).$model->id_realisasi;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Realisasi Sasaran Kerja'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_realisasi, 'url' => ['view', 'id' => $model->id_realisasi]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="realisasi-sasaran-kerja-update">

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">vertical_split</i>
                </div>
                <h4 class="card-title"><?= $this->title; ?></h4>
            </div>
            <div class="card-body ">

                <?=
                $this->render('_form', [
                    'model' => $model,
                ]);
                ?>

            </div>
        </div>
    </div>
</div>