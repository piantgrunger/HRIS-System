<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\Banding */

$this->title = $model->id_banding;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Pembelaan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banding-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
             <?php if ((Mimin::checkRoute($this->context->id."/update"))){ ?>        <?= Html::a(Yii::t('app', 'Ubah'), ['update', 'id' => $model->id_banding], ['class' => 'btn btn-primary']) ?>
        <?php } if ((Mimin::checkRoute($this->context->id."/delete"))){ ?>        <?= Html::a(Yii::t('app', 'Hapus'), ['delete', 'id' => $model->id_banding], [
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
            'tgl_banding',
            'id_pegawai',
            'id_atasan',
            'id_absen',
            'alasan:ntext',
            'file',
            'status_banding',
        ],
    ]) ?>

</div>
