<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\Golongan */

$this->title = $model->kode_golongan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Golongan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="golongan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
             <?php if ((Mimin::checkRoute($this->context->id."/update"))){ ?>        <?= Html::a(Yii::t('app', 'Ubah'), ['update', 'id' => $model->id_golongan], ['class' => 'btn btn-primary']) ?>
        <?php } if ((Mimin::checkRoute($this->context->id."/delete"))){ ?>        <?= Html::a(Yii::t('app', 'Hapus'), ['delete', 'id' => $model->id_golongan], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Apakah Anda yakin ingin menghapus item ini??'),
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode_golongan',
            'nama_golongan',
            'nilai_jabatan',
            'ikkd',
            'tpp_dinamis',
            'tpp_statis',
        ],
    ]) ?>

</div>
