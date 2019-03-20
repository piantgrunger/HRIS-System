<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Shift */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Shift',
]).$model->id_shift;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Shift'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_shift, 'url' => ['view', 'id' => $model->id_shift]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="shift-update">

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">access_time</i>
                </div>
                <h4 class="card-title"><?= Html::encode($this->title); ?> </h4>
            </div>
            <div class="card-body ">
                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>
            </div>
        </div>
    </div>
</div>

</div>
