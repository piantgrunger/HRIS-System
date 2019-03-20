<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SasaranKinerjaPegawai */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Sasaran Kinerja Pegawai',
]) . $model->id_skp;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Sasaran Kinerja Pegawai'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_skp, 'url' => ['view', 'id' => $model->id_skp]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sasaran-kinerja-pegawai-update">

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">work</i>
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