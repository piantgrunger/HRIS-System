<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RiwayatJabatan */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Riwayat Jabatan',
]) . $model->id_riwayat_jabatan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Riwayat Jabatan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_riwayat_jabatan, 'url' => ['view', 'id' => $model->id_riwayat_jabatan]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="riwayat-jabatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
