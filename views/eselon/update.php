<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Eselon */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Eselon',
]) . $model->id_eselon;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Eselon'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_eselon, 'url' => ['view', 'id' => $model->id_eselon]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="eselon-update">

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">event_seat</i>
                </div>
                <h4 class="card-title"><?=$this->title?></h4>
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