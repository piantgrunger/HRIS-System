<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HitungTunjangan */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Hitung Tunjangan',
]) . $model->id_hitung_tunjangan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Hitung Tunjangan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_hitung_tunjangan, 'url' => ['view', 'id' => $model->id_hitung_tunjangan]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="hitung-tunjangan-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
