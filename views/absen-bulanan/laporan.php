<?php
use yii\helpers\Url;
use Endroid\QrCode\QrCode;

$url = Yii::$app->request->url;
$qrCode = new QrCode($url);
$path = Yii::getAlias('@app').'/web';
$laporan = $path . '/Image/qrcodelaporan' . $nama_skpd . $bulan . $tahun . '.png';
if (!file_exists($laporan)) {
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

    $qrCode->writeFile($laporan);
    chmod($laporan, 0777);
}
$pathlaporan = Url::to(['/Image/qrcodelaporan'.$nama_skpd.$bulan.$tahun.'.png'], true);

$this->title = "LAPORAN ABSENSI <br> $nama_skpd <br>   ".strtoupper($bulan)." $tahun";

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
    vertical-align: bottom;font-family:cambria;font-size:12px;"><h3><p     align='center'><b><?=$this->title; ?><br>
</p></h3>

</div>
</div>

<br>
<br>
<table class="table  table-striped  table-bordered">
<thead>
<tr>
<th rowspan=2 style="font-family:cambria;font-size:12px;">No.</th>
<th rowspan=2  style="font-family:cambria;font-size:12px;" width="30%" >NAMA / NIP</th>
<th rowspan=2  style="font-family:cambria;font-size:12px;">JK</th>
<?php for ($i = 1; $i <= 15; ++$i) {
    echo "<th colspan=2  style=\"font-family:cambria;font-size:12px;\">$i</th>";
}?>
</tr>
<tr>
<?php for ($i = 1; $i <= 15; ++$i) {
    echo '<th  style="font-family:cambria;font-size:12px;" >Pagi</th>';
    echo '<th  style="font-family:cambria;font-size:12px;" >Siang</th>';
} ?>
</tr>

</thead>
<tbody>
<?php
$j = 1;
  foreach ($model as $data) {
      echo '<tr>';
      echo "<td  style=\"font-family:cambria;font-size:12px;\"> $j</td>";
      ++$j;

      echo "<td  style=\"font-family:cambria;font-size:12px;\"><b>$data->nama_lengkap</b><br>$data->nip </td>";
      echo '<td  style="font-family:cambria;font-size:12px;">'.$data->pegawai->jenis_kelamin.'</td>';
      for ($i = 1; $i <= 15; ++$i) {
          $potongPagi = $data->__get($i.'_pagi_potong');
          $potongSiang = $data->__get($i.'_siang_potong');

          echo '<td  style="font-family:cambria;font-size:12px;"><p style="'.(($potongPagi > 0) ? 'color:red' : '').'" > '.$data->__get($i.'_pagi').'</p></td>';
          echo '<td  style="font-family:cambria;font-size:12px;"><p style="'.(($potongSiang > 0) ? 'color:red' : '').'" >'.$data->__get($i.'_siang').'</p></td>';
      }

      echo '</tr>';
  }

?>

</tbody>

</table>
<table class="table  table-striped  table-bordered">
<thead>
<tr>
<th rowspan=2  style="font-family:cambria;font-size:12px;">No.</th>
<th rowspan=2 width="30%"  style="font-family:cambria;font-size:12px;" >NAMA / NIP</th>
<th rowspan=2  style="font-family:cambria;font-size:12px;">JK</th>
<?php for ($i = 16; $i <= 31; ++$i) {
    echo "<th colspan=2  style=\"font-family:cambria;font-size:12px;\">$i</th>";
} ?>
</tr>
<tr>
<?php for ($i = 16; $i <= 31; ++$i) {
    echo '<th  style="font-family:cambria;font-size:12px;" >Pagi</th>';
    echo '<th  style="font-family:cambria;font-size:12px;">Siang</th>';
} ?>
</tr>

</thead>
<tbody>
<?php
$j = 1;
foreach ($model as $data) {
    echo '<tr>';
    echo "<td  style=\"font-family:cambria;font-size:12px;\"> $j</td>";
    ++$j;

    echo "<td  style=\"font-family:cambria;font-size:12px;\"><b>$data->nama_lengkap</b><br>$data->nip </td>";
    echo '<td  style="font-family:cambria;font-size:12px;">'.$data->pegawai->jenis_kelamin.'</td>';
    for ($i = 16; $i <= 31; ++$i) {
        $potongPagi = $data->__get($i.'_pagi_potong');
        $potongSiang = $data->__get($i.'_siang_potong');

        echo '<td  style="font-family:cambria;font-size:12px;"><p style="'.(($potongPagi > 0) ? 'color:red' : '').'" > '.$data->__get($i.'_pagi').'</p></td>';
        echo '<td  style="font-family:cambria;font-size:12px;" ><p style="'.(($potongSiang > 0) ? 'color:red' : '').'" >'.$data->__get($i.'_siang').'</p></td>';
    }

    echo '</tr>';
}

?>

</tbody>

</table>

<br>
<br>

<div class="col-md-6">
<div class="header" style="margin-bottom :40px">
<div class="image" style="background:  no-repeat;  width: 250px; height: 150px; float: left;
    display: inline-block;font-family:cambria;font-size:12px;">   Verifikator Absensi<br>
        <?= $nama_skpd; ?>,<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>
   <b><u>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </u></b>
        <br>
        Tanggal Verifikasi : <?=\Yii::$app->formatter->asDate(date('Y-m-d'), 'long'); ?>
        </p>

</div>
<div class="image" style="background-size:cover;  width: 250px; height: 150px; float: right;
    display: inline-block;font-family:cambria;font-size:12px;">
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
