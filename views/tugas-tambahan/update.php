<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TugasTambahan */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tugas Tambahan',
]).$model->id_tugas_tambahan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Tugas Tambahan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tugas_tambahan, 'url' => ['view', 'id' => $model->id_tugas_tambahan]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tugas-tambahan-update">
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">work</i>
                </div>
                <h4 class="card-title"><?= Html::encode($this->title); ?> </h4>
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
