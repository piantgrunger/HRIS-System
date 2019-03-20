<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LevelJabatan */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Level Jabatan',
]).$model->id_level_jabatan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Level Jabatan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_level_jabatan, 'url' => ['view', 'id' => $model->id_level_jabatan]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="level-jabatan-update">

    <h3><?= Html::encode($this->title); ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
