<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tunjangan */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tunjangan',
]) . $model->kode_tunjangan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Tunjangan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode_tunjangan, 'url' => ['view', 'id' => $model->id_tunjangan]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tunjangan-update">
<div class="tunjangan-create">

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">money</i>
                </div>
                <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
            </div>
            <div class="card-body ">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
        </div>
    </div>
</div>

</div>

