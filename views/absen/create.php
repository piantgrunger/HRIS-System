<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Absen */

$this->title = Yii::t('app', 'Absen Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Absen'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="absen-create">

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">calendar_today</i>
                </div>
                <h4 class="card-title">Absen Baru</h4>
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
