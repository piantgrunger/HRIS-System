<?php
use yii\helpers\Url;
use Endroid\QrCode\QrCode;

$url = Yii::$app->request->url;
$qrCode = new QrCode($url);
$path = Yii::getAlias('@app').'/web';
 // Set advanced options
$laporan = $path . '/Image/qrcodelaporan' . $nama_skpd . $bulan . $tahun . '.png';
if (!file_exists($laporan)) {
    $qrCode->setWriterByName('png');
    $qrCode->setMargin(10);
    $qrCode->setEncoding('UTF-8');
    $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
    $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
    $qrCode->setLogoWidth(150);
    $qrCode->setRoundBlockSize(true);
    $qrCode->setValidateResult(false);

    $qrCode->writeFile($laporan);
    chmod($laporan, 0777);
}
$pathlaporan = Url::to(['/Image/qrcodelaporan'.$nama_skpd.$bulan.$tahun.'.png'], true);

$this->title = "REKAP ABSENSI <br> $nama_skpd <br> $bulan $tahun";

?>

<div class="lokasi-index">

<div class="col-md-6">
<div class="header" style="margin-bottom :40px">
<div class="image" style="background: url('<?= Url::to(['/Image/logo.png']); ?>') no-repeat;background-size:cover;  width: 95px; height: 125px; float: left;
    display: inline-block;"></div>
<div class="image" style="background: url('<?= $pathlaporan; ?>') no-repeat;background-size:cover;  width: 95px; height: 115px; float: right;
    display: inline-block;"></div>

<div class="text" style="float: left;
    display: inline-block;
    vertical-align: bottom;"><h3><p     align='center'><b><?= $this->title; ?><br>
</p></h3>

</div>
</div>

<hr>
<br>
<br>
<table class="table  table-striped  table-bordered">
<thead>
<tr>
<th>No.</th>
<th width="40%"  >NAMA / NIP</th>
<th >JK</th>
<th width="10%">Terlambat (Jam)</th>
<th width="10%">Tanpa Keterangan</th>
<th width="10%">Ijin</th>
<th width="10%">Cuti</th>
<th width="10%">Sakit</th>
<th width="10%">Dinas Luar</th>
<th width="10%">Ijin Pagi</th>
<th width="10%">Ijin Sore</th>


</tr>

</thead>
<tbody>
<?php
  $i = 1;
  foreach ($model as $data) {
      echo '<tr>';
      echo "<td>$i</td>";
      echo "<td ><b>$data->nama_lengkap</b><br>$data->nip </td>";
      echo '<td>'.$data->pegawai->jenis_kelamin.'</td>';
      echo '<td>'.round($data->terlambat, 0).'</td>';

      echo '<td>'.$data->tanpa_keterangan.'</td>';
      echo '<td>'.$data->ijin.'</td>';
      echo '<td>'.$data->cuti.'</td>';
      echo '<td>'.$data->sakit.'</td>';
      echo '<td>'.$data->dinas_luar.'</td>';
      echo '<td>'.$data->ijin_pagi.'</td>';
      echo '<td>'.$data->ijin_sore.'</td>';

      echo '</tr>';
      ++$i;
  }

?>

</tbody>

</table>

<br>
<br>

<div class="col-md-6">
<div class="header" style="margin-bottom :40px">
<div class="image" style="background:  no-repeat;  width: 250px; height: 150px; float: left;
    display: inline-block;">   Verifikator Absensi<br>
        <?= $nama_skpd; ?>,<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>
   <b><u>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </u></b>
        <br>
        Tanggal Verifikasi : <?= \Yii::$app->formatter->asDate(date('Y-m-d'), 'long'); ?>
        </p>

</div>
<div class="image" style="background-size:cover;  width: 250px; height: 150px; float: right;
    display: inline-block;">
  Kepala Dinas <br>
        <?= $nama_skpd; ?>,<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>
   <b><u>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </u></b>
        <br>
        </p>

</div>
</div>
