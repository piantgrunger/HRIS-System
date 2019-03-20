<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\JabatanFungsional */

$this->title = $model->nama_jabatan_fungsional;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Jabatan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jabatan-fungsional-view">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
             <?php if ((Mimin::checkRoute($this->context->id.'/update'))) {
    ?>        <?= Html::a(Yii::t('app', 'Ubah'), ['update', 'id' => $model->id_jabatan_fungsional], ['class' => 'btn btn-primary']); ?>
        <?php
} if ((Mimin::checkRoute($this->context->id.'/delete'))) {
        ?>        <?= Html::a(Yii::t('app', 'Hapus'), ['delete', 'id' => $model->id_jabatan_fungsional], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Apakah Anda yakin ingin menghapus item ini??'),
                'method' => 'post',
            ],
        ]); ?>
        <?php
    } ?>    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama_jabatan_fungsional',
            'nama_unit_kerja',
            'nama_satuan_kerja',
        ],
    ]); ?>

</div>
