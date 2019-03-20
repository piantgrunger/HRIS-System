<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\Penilaian */

$this->title = $model->id_penilaian;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Penilaian'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
             <?php if ((Mimin::checkRoute($this->context->id."/update"))){ ?>        <?= Html::a(Yii::t('app', 'Ubah'), ['update', 'id' => $model->id_penilaian], ['class' => 'btn btn-primary']) ?>
        <?php } if ((Mimin::checkRoute($this->context->id."/delete"))){ ?>        <?= Html::a(Yii::t('app', 'Hapus'), ['delete', 'id' => $model->id_penilaian], [
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
            'bulan',
            'tahun',
            'orientasi_pelayanan',
            'integritas',
            'komitmen',
            'disiplin',
            'kerjasama',
            'kepemimpinan',
            'jumlah',
            'rata_rata',
            'status',
            'id_pegawai',
            'id_penilai',
        ],
    ]) ?>

</div>
