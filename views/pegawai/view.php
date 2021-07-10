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
<div class="panel-heading"><i class="glyphicon glyphicon-tasks"></i><b> Data </b></div>
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




</div>