<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TugasTambahan */

$this->title = Yii::t('app', 'Tugas Tambahan Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Tugas Tambahan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tugas-tambahan-create">
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
