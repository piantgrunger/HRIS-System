<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\settings\Modules */

$this->title = 'Module';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body text-left">
                <?= Html::a('<i class="material-icons">keyboard_arrow_left</i> Back', ['settings/modules'], ['class' => 'btn btn-default']) ?>
                <?= Html::a('<i class="material-icons">edit</i>' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                <?=
                Html::a('<i class="material-icons">close</i>' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ])
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">contacts</i>
                </div>
                <h4 class="card-title"><?= Html::encode($this->title) ?> -
                    <small class="description">Detail</small>
                </h4>
            </div>
            <div class="card-body ">
                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id', 'name', 'url', 'label', 'fa_icon'
                    ]
                ])
                ?>
            </div>
        </div>
    </div>
</div>
