<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$js = "
      var qty = $('#sasarankinerjapegawai-kuantitas').val();
      let waktu = $('#sasarankinerjapegawai-waktu').val();
      var bagi = parseFloat(qty/waktu).toFixed(2);
      bulan =['Januari','Februari','Maret' ,'April','Mei' ,'Juni','Juli','Agustus','September' ,'Oktober','November' ,'Desember'];
    $('#table-detail > tbody').html(\"\");
      let satuan = $('#sasarankinerjapegawai-satuan_kuantitas').val();
      for (i=0;i<12;i++){

$('#table-detail > tbody').append('<tr class=\"mdm-item\" data-key=\"'+i+'\" data-index=\"'+i+'\">'+
                                               '<td>'+
                                               (i+1) +
                                               '</td>'+
                                               '<td>'+
                                              '<div class=\"form-group field-detsasarankinerjapegawai-'+i+'bulan\">'+
                                              ' <input type=\"hidden\" value=\"'+(i+1)+'\" name=\"detsasarankinerjapegawai['+i+'][bulan] \"> '+
                                             bulan[i]+
                                              '</div>'+
                                               '</td>'+
                                               '<td>'+
                                               '<div class=\"form-group field-detsasarankinerjapegawai-'+i+'kuantitas\">'+
                                            '<input type=\"text\" id=\"detsasarankinerjapegawai-'+i+'-kuantitas\" class=\"form-control\"  name=\"detsasarankinerjapegawai['+i+'][kuantitas]\" aria-invalid=\"false\" value =\"'+((qty>0)?bagi:0)+'\"\>'+
                                             '<div class=\"help-block\"></div>'+

                                              '</div>'+
                                               '</td>'+
                                             '<td>'+
                                               '<div class=\"form-group field-detsasarankinerjapegawai-'+i+'satuan_kuantitas\">'+
                                            satuan+
                                               '<input type=\"hidden\" id=\"detsasarankinerjapegawai-'+i+'-satuan_kuantitas\" class=\"form-control\"  name=\"detsasarankinerjapegawai['+i+'][satuan_kuantitas]\" aria-invalid=\"false\" value =\"'+satuan+'\"\>'+
                                             '<div class=\"help-block\"></div>'+

                                              '</div>'+
                                               '</td>'+

                                               '</tr>');
                                               qty = qty - bagi;



      }


";


/* @var $this yii\web\View */
/* @var $model app\models\SasaranKinerjaPegawai */
/* @var $form yii\widgets\ActiveForm */



?>

<div class="sasaran-kinerja-pegawai-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->
        <div class="row">

        <label class="col-md-1 col-form-label">Periode</label>
`           <label class="col-md-4 col-form-label text-left justify-content-start">1 Januari  <?= $model->tahun ?> &nbsp; s.d&nbsp;31 Desember  <?= $model->tahun ?> </label>
</div>
        <div class="row">
        <label class="col-md-1 col-form-label">Penilai</label>
`           <label class="col-md-4 col-form-label text-left justify-content-start"><?= $model->penilai->nama_lengkap; ?></label>
</div>
<div class="row">
<label class="col-md-1 col-form-label"></label>
<label class="col-md-4 col-form-label text-left justify-content-start"><?= $model->penilai->nama_jabatan; ?> &nbsp;<?= $model->penilai->nama_satuan_kerja; ?> </label>
       </div>
<br>
<br>

        <div class="row">
        <label class="col-md-2 col-form-label">Uraian Tugas</label>
`           <label class="col-md-8 col-form-label text-left justify-content-start"><?= $form->field($model, 'uraian_tugas')->textarea(['rows' => 4])->label(false) ?></label>
    </div>



        <div class="row">
        <label class="col-md-2 col-form-label">Kuantitas</label>
`           <label class="col-md-4 col-form-label text-left justify-content-start">    <?= $form->field($model, 'kuantitas')->textInput(['maxlength' => true])->label(false) ?></label>

            <label class="col-md-4 col-form-label text-left justify-content-start">    <?= $form->field($model, 'satuan_kuantitas')->textInput(['maxlength' => true])->label(false) ?></label>
</div>



        <div class="row">
        <label class="col-md-2 col-form-label">Waktu</label>
`           <label class="col-md-4 col-form-label text-left justify-content-start">    <?= $form->field($model, 'waktu')->textInput(['maxlength' => true])->label(false) ?></label>
            <label class="col-md-4 col-form-label text-left justify-content-start">    <?= $form->field($model, 'satuan_waktu')->dropDownList(['Bulan' => 'Bulan'])->label(false) ?></label>
</div>
\
        <div class="row">
    <label class="col-md-2 col-form-label">Angka Kredit</label>
`           <label class="col-md-3 col-form-label text-left justify-content-start">    <?= $form->field($model, 'angka_kredit')->textInput(['maxlength' => true])->label(false) ?></label>

        <label class="col-md-2 col-form-label">Biaya</label>
`           <label class="col-md-3 col-form-label text-left justify-content-start">    <?= $form->field($model, 'biaya')->textInput(['maxlength' => true])->label(false) ?></label>

</div>

<?= Html::button(
        'Hitung Breakdown SKP',
        [
                'class' => 'btn btn-primary',
                'onClick' => $js
        ]
) ?>


<div class="panel panel-primary"   >
<div class="panel-heading"> Detail SKP Bulanan

</div>
<div class="panel-body">


<table id="table-detail" class="table table-bordered table-hover kv-grid-table kv-table-wrap">
    <thead>
        <tr>
            <th>No.</th>
            <th width="50%">Bulan</th>
            <th>Kuantitas</th>
            <th>Satuan</th>

        </tr>
    </thead>
    <?= \mdm\widgets\TabularInput::widget([
                'id' => 'detail-grid',
                'allModels' => $model->detailSasaranKinerjaPegawai,
                'model' => \app\models\detsasarankinerjapegawai::className(),
                'tag' => 'tbody',
                'form' => $form,
                'itemOptions' => ['tag' => 'tr'],
                'itemView' => '_item_skp',
                'clientOptions' => [
                        'btnAddSelector' => '#btn-add2',
                ]

        ]);
        ?>
    </table>


</div>
</div>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

        <?= $form->field($model, 'id_pegawai')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'id_penilai')->hiddenInput()->label(false); ?>

   <?= $form->field($model, 'tahun')->hiddenInput()->label(false); ?>

    <?php ActiveForm::end(); ?>

</div>
