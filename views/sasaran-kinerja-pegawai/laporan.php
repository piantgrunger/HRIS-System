<?php

use yii\helpers\Url;
use Endroid\QrCode\QrCode;

$pegawai = Yii::$app->user->identity->pegawai;
$atasan = Yii::$app->user->identity->pegawai->pegawai_atasan;


$url = Yii::$app->request->url;
$qrCode = new QrCode($url);
$path = Yii::getAlias('@app') . '/web';
 // Set advanced options
$qrCode->setWriterByName('png');
$qrCode->setMargin(10);
$qrCode->setEncoding('UTF-8');
$qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
$qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
$qrCode->setLogoWidth(95);
$qrCode->setLogoHeight(95);
$qrCode->setRoundBlockSize(true);
$qrCode->setValidateResult(false);

$laporan = $path . '/Image/qrcodelaporanskp.png';
$qrCode->writeFile($laporan);
chmod($laporan, 0777);
$pathlaporan = Url::to(['/Image/qrcodelaporanskp.png'], true);

$this->title = "FORMULIR SASARAN KINERJA <br> APARATUR SIPIL NEGARA ";

?>

<div class="lokasi-index">

<div class="col-md-6">
<div class="header" style="margin-bottom :40px">
<div class="image" style="background: url('<?= Url::to(['/Image/logo.png']); ?>') no-repeat;background-size:contain;  width: 95px; height: 80px; float: left;
    display: inline-block;"></div>
<div class="image" style="background: url('<?= $pathlaporan; ?>') no-repeat;background-size:cover;  width: 80px; height: 80px; float: right;
    display: inline-block;"></div>

<div class="text" style="float: left;
    display: inline-block;
    vertical-align: bottom;font-family:cambria;font-size:12px;"><h3><p     align='center'><b><?= $this->title; ?><br>
</p></h3>

</div>
</div>

<br>
<br>

<table  cellspacing="1px" style="border-collapse: collapse;" border=1  width="100%" >

  <tr>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;<b>No.</b>&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;" colspan=2 > &nbsp; <b> I. Pejabat Penilai </b>&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;<b>No.</b>&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;" colspan=2> &nbsp; <b>II. Pegawai Negeri Sipil yang Dinilai  </b>&nbsp;</td>

  </tr>

  <tr>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;1.&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;Nama&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;<?=$atasan->nama_lengkap; ?>&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;1.&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;Nama&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;<?=$pegawai->nama_lengkap; ?>&nbsp;</td>

  </tr>

  <tr>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;2.&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;NIP&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;<?=$atasan->nip; ?>&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;2.&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;NIP&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;<?=$pegawai->nip; ?>&nbsp;</td>

  </tr>

  <tr>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;3.&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;Pangkat / Gol . Ruang&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;<?=$atasan->nama_golongan.' ( '.$atasan->kode_golongan.' )'; ?>&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;3.&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;Pangkat / Gol . Ruang&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;<?=$pegawai->nama_golongan.' ( '.$pegawai->kode_golongan.' )'; ?>&nbsp;</td>

  </tr>

  <tr>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;4.&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;Jabatan&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;<?=$atasan->nama_jabatan; ?>&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;4.&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;Jabatan&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;<?=$pegawai->nama_jabatan; ?>&nbsp;</td>

  </tr>
  <tr>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;5.&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;Satuan Kerja&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;<?=$atasan->nama_satuan_kerja; ?>&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;5.&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;Satuan Kerja&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"> &nbsp;<?=$pegawai->nama_satuan_kerja; ?>&nbsp;</td>

  </tr>

</table>

<br>
<br>


<table  cellspacing="1px" style="border-collapse: collapse;" border=1 width="100%"   >

  <tr>
      <td style ="font-family:cambria;font-size:12px;" rowspan=2 align="center"> &nbsp;<b>No.</b>&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"  rowspan=2 align="center" > &nbsp; <b> III. Kegiatan yang Dinilai </b>&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;" rowspan=2 align="center"> &nbsp;<b>AK</b>&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;" colspan=4 align="center">  &nbsp;<b>Target  </b>&nbsp;</td>

  </tr>

  <tr>
      <td style ="font-family:cambria;font-size:12px;" colpan=2 align="center"> &nbsp;<b>Kuantitas / Output</b>&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;"  align="center"> &nbsp; <b> Kual / Mutu </b>&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;" colpan=2 align="center"> &nbsp;<b>Waktu</b>&nbsp;</td>
      <td style ="font-family:cambria;font-size:12px;" align="center">  &nbsp;<b>Biaya  </b>&nbsp;</td>

  </tr>
<?php
 $i=1;
 foreach ($model as $data) {
     ?>
     <tr>
     <td  style ="font-family:cambria;font-size:12px;" align="center">&nbsp; <?=$i?>&nbsp; </td>

     <td   style ="font-family:cambria;font-size:12px;" >&nbsp; <?= $data->uraian_tugas ?>&nbsp; </td>
     <td   style ="font-family:cambria;font-size:12px;" >&nbsp; <?= $data->angka_kredit ?>&nbsp; </td>
     <td  style ="font-family:cambria;font-size:12px;" >&nbsp; <?= $data->kuantitas ?>&nbsp;<?= $data->satuan_kuantitas ?> &nbsp; </td>
     <td  style ="font-family:cambria;font-size:12px;" >&nbsp; 100%&nbsp; </td>
     <td  style ="font-family:cambria;font-size:12px;" >&nbsp; <?= $data->waktu ?>&nbsp; <?= $data->satuan_waktu ?>&nbsp;  </td>
     <td  style ="font-family:cambria;font-size:12px;" >&nbsp; <?= $data->biaya ?>&nbsp; </td>




     </tr>

     <?php
     $i++;
 }

?>



</table>

</div>
<br><br><br>

<div class="col-md-6">
<div class="header" style="margin-bottom :40px">
<div class="image" style="background:  no-repeat;  width: 250px; height: 150px; float: left;
    display: inline-block;">
  Pejabat Penilai , <br>

        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>

   <b><u> <?= $atasan->nama_lengkap ?>
   </u></b>
        <br>
        <?= $atasan->nip ?>
        </p>

</div>
<div class="image" style="background-size:cover;  width: 250px; height: 150px; float: right;
    display: inline-block;">
    Banjarbaru    <?= \Yii::$app->formatter->asDate(date('Y-m-d'), 'long'); ?> <br>

  Pegawai Negeri Sipil yang Dinilai<br>

        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>

   <b><u> <?=$pegawai->nama_lengkap?>
   </u></b>
        <br>
        <?=$pegawai->nip?>
        </p>

</div>
</div>
