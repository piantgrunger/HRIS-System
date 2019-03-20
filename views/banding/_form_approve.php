<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<div class="banding-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->


        <div class="row">
        <label class="col-md-3 col-form-label">Keputusan</label>
        <div class="col-md-4">
            <?= $form->field($model, 'status_banding')->radioList([
                'Belum Diapprove' =>  'Belum Diapprove' ,
              'Diterima' => 'Diterima',
                'Ditolak' => 'Ditolak',

                ], ['prompt' => 'Keputusan ... '])->label(false); ?>
        </div>
        <div class="col-md-2">
        <?= Html::submitButton(Yii::t('app', 'Approve'), ['class' => 'btn btn-success']); ?>
    </div>
    </div>





        <div class="row">
        <label class="col-md-3 col-form-label">Nama</label>
`           <label class="col-md-6 col-form-label text-left justify-content-start"><?=$model->nama_pegawai; ?></label>
</div>
<div class="row">
<label class="col-md-3 col-form-label"></label>
<label class="col-md-6 col-form-label text-left justify-content-start"><?=$model->pegawai->nama_jabatan; ?> &nbsp;<?=$model->pegawai->nama_satuan_kerja; ?> </label>
       </div>
<br>
<br>

       <div class="row">
        <label class="col-md-3 col-form-label">Absen
        </label>
        <label class="col-md-6 col-form-label text-left justify-content-start"><?=$model->ket; ?> </label>

    </div>

    <div class="row">
        <label class="col-md-3 col-form-label">Pembelaan</label>
        <label class="col-md-6 col-form-label text-left justify-content-start"><?=$model->alasan; ?> </label>

     </div>

    <div class="row">
        <label class="col-md-3 col-form-label">File Pendukung</label>
        <label class="col-md-6 col-form-label text-left justify-content-start">      <a data-pjax=0 href="<?= Url::to(['/document/' . $model->file]) ?>" alt="...">
                         Download</a>
                 </label>

     </div>



    <?php ActiveForm::end(); ?>

</div>
