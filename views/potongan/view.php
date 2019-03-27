<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\Potongan */

$this->title = $model->kode_potongan;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Potongan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="potongan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
             <?php if ((Mimin::checkRoute($this->context->id."/update"))){ ?>        <?= Html::a(Yii::t('app', 'Ubah'), ['update', 'id' => $model->id_potongan], ['class' => 'btn btn-primary']) ?>
        <?php } if ((Mimin::checkRoute($this->context->id."/delete"))){ ?>        <?= Html::a(Yii::t('app', 'Hapus'), ['delete', 'id' => $model->id_potongan], [
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
            'kode_potongan',
            'nama_potongan',
            'jenis_potongan',
            'jumlah',
            'keterangan:ntext',
        ],
    ]) ?>

</div>
