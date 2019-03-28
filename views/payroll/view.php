<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hscstudio\mimin\components\Mimin;

/* @var $this yii\web\View */
/* @var $model app\models\Pegawai */

$this->title = $model->id_pegawai;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Pegawai'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class=pegawai-view>
<div class=row>



<div class="col-md-7">
<div class="panel panel-info">
<div class="panel-heading"><i class="glyphicon glyphicon-tasks"></i><b> Data Pejabat</b></div>
<div class="panel-body">
<br>
 <b><?=$model->nama_jabatan;?> PADA <?= $model->nama_satuan_kerja; ?>  </b>
 <hr>
 TMT Jabatan : <?=yii::$app->formatter->asDate($model->tmt) ?>
 <hr>
 <b><?= $model->nama_lengkap; ?>  </b>
 <hr>
  NIP : <?=$model->nip?>
<hr>
<?=$model->pangkat?><br>
Jabatan Tambahan :  <?=$model->nama_jabatan_tambahan ?>

</div>
</div>
</div>
<div class="col-md-5">
<div class="panel panel-info">
<div class="panel-heading"><i class="glyphicon glyphicon-tasks"></i><b> Foto</b></div>
<div class="panel-body">
 <?= Html::img(['/media/' . $model->foto], ['class' => 'img-responsive', 'width' => '100%']); ?>
</div>
</div>
</div>

</div>
</div>

<div class=row>



<div class="col-md-6">
<div class="panel panel-info">
<div class="panel-heading"><i class="glyphicon glyphicon-tasks"></i><b> Profil Pejabat</b></div>
<div class="panel-body">
<br>
<b>Jabatan</b><br><br>
<?php
           foreach ($model->riwayat_jabatan as $detail) {
               echo yii::$app->formatter->asDate($detail->tmt) ." - ". $detail->nama_jabatan ." PADA ".$detail->unit_kerja  ."<hr>";
           }

?>

</div>
</div>
</div>
<div class="col-md-6">
<div class="panel panel-info">
<div class="panel-heading"><i class="glyphicon glyphicon-tasks"></i><b> Diklat</b></div>
<div class="panel-body">
<?php
foreach ($model->riwayat_diklat as $detail) {
    echo yii::$app->formatter->asDate($detail->tgl_mulai) . " - " . yii::$app->formatter->asDate($detail->tgl_selesai) ." : " . $detail->nama_diklat . "<hr>";
}

?>

</div>
</div>
</div>

</div>
</div>

</div>