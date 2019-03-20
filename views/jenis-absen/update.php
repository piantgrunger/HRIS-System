<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JenisAbsen */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Jenis Absen',
]) . $model->id_jenis_absen;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Jenis Absen'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_jenis_absen, 'url' => ['view', 'id' => $model->id_jenis_absen]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="jenis-absen-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
