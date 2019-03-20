<?php
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\helpers\Html;

?>

<?php if (!is_null(Yii::$app->user->identity->pegawai)) {
    $model = Yii::$app->user->identity->pegawai;
    $foto = Url::to(['/media/' . $model->foto]); ?>

 <div class="row">
<div class="col-md-4">
<div class="card card-profile">
                <div class="card-avatar">
                  <a href="#pablo">
                    <img class="img" src="<?= $foto; ?>">
                  </a>
                </div>
             <div class="card-body">
                  <h6 class="card-category text-gray"><?= $model->nip; ?></h6>
                  <h6 class="card-category text-gray"><?= $model->nama_jabatan; ?></h6>

                  <h4 class="card-title"><?= $model->nama_lengkap; ?></h4>
                  <p class="card-description">

                  </p>
                  <a href="<?= Url::to(['/absen/index']); ?>" class="btn btn-success btn-round">Data Absen</a>
                  <a href="<?= Url::to(['/hitung-tunjangan/index']); ?>" class="btn btn-info btn-round">Data Tunjangan</a>
                  <?= Html::a(
        "Upload Kelengkapan",
        Url::to(['/pegawai/upload-kelengkapan', 'id' => $model->id_pegawai]),
        [
                      'title' => 'ubah', 'class' => 'btn btn-primary btn-round',
                    ]
                  ) ?>
                </div>
              </div>

</div>





 <div class="col-md-8">



	                        <div class="card card-user">


	                            <div class="card-header card-header-primary">
                              <h4 class="title">Biodata</h4>
                              <p class="category">  *Jika Terjadi Kesalahan Data Harap Hubungi Administrator</p>
	                            </div>
	                            <div class="card-content">
<?php
    echo DetailView::widget([
    'model' => $model,
    'attributes' => [
      'nip',
      'nik',
      'nama_lengkap',
      'alamat:ntext',
      'nama_jabatan',
      'jenis_kelamin',
      'tempat_lahir',
      'tanggal_lahir:date',
      'nama_satuan_kerja',
      'kode_golongan',
    ],
  ]); ?>

</div>

</div>
</div>



</div>
<?php
}
?>

</div>
