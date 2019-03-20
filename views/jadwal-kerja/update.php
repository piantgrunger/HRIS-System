<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JadwalKerja */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Jadwal Kerja',
]) . $model->id_jadwal;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Jadwal Kerja'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_jadwal, 'url' => ['view', 'id' => $model->id_jadwal]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="jadwal-kerja-update">

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">calendar_today</i>
                </div>
                <h4 class="card-title"><?= $this->title ?></h4>
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

</div>

</div>
