<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JenisAbsen */

$this->title = Yii::t('app', 'Jenis Absen Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Jenis Absen'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-absen-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
