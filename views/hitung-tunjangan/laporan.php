<?php

use yii\widgets\DetailView;
use yii\helpers\Url;
use Endroid\QrCode\QrCode;
use app\helpers\myhelpers;

$url = Yii::$app->request->url;
$qrCode = new QrCode($url);
$path = Yii::getAlias('@app').'/web';
$laporan = $path . '/Image/qrcodelaporan' . $model->nama_satuan_kerja . $model->tgl_awal . '.png';
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
$pathlaporan = Url::to(['/Image/qrcodelaporan'.$model->nama_satuan_kerja.$model->tgl_awal.'.png'], true);

$this->title = 'PERHITUNGAN TAMBAHAN PENGHASILAN PEGAWAI <br>'.$model->nama_satuan_kerja.'<br> BULAN '.
     strtoupper(myhelpers::getMonth(intval(explode('-', $model->tgl_awal)[1])).' '.explode('-', $model->tgl_awal)[0]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Hitung Tunjangan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$total = 0;
?>
<div class="hitung-tunjangan-view" style ="font-family:cambria;" >


<div class="col-md-6">
<div class="header" style="margin-bottom :40px">
<div class="image" style="background: url('<?= Url::to(['/Image/logo.png']); ?>') no-repeat;background-size:contain;  width: 95px; height: 80px; float: left;
    display: inline-block;"></div>
<div class="image" style="background: url('<?= $pathlaporan; ?>') no-repeat;background-size:cover;  width: 80px; height: 80px; float: right;
    display: inline-block;"></div>

<div class="text" style="float: left;
    display: inline-block;
    vertical-align: bottom;font-family:cambria;font-size=12px " ><h4><p     align='center'><b><?= $this->title; ?><br>
</p></h4>

</div>

</div>
<br>
<br>
<div class="detail" >

  <div style="font-family:cambria;font-size:12px;">
    <?= DetailView::widget([
        'options' =>['style' => 'font-family:cambria;font-size:12px'],
        'model' => $model,
        'attributes' => [
            'tgl_awal:date',
            'tgl_akhir:date',
                  'nama_satuan_kerja',

            [
                'label' => 'Total TPP',
                'value' => \Yii::$app->formatter->asDecimal($model->total_tpp_sebelum_pajak, 0),
            ],

        ],
    ]); ?>
    </div>

<table  cellspacing="1px" style="border-collapse: collapse;" border=1   >
  <thead >
  <tr>

<th align="center" style="font-family:cambria;font-size:12px;">No.</th>

<th  align="center" style="font-family:cambria;font-size:12px;">Nama / NIP </th>
<th  align="center" style="font-family:cambria;font-size:12px;"> Jabatan</th>
<th align="center" style="font-family:cambria;font-size:12px;">Golongan</th>
<th align="center" style="font-family:cambria;font-size:12px;">Jumlah Absen</th>
<th align="center" style="font-family:cambria;font-size:12px;">Potongan Terlambat (Jam)</th>
<th align="center" style="font-family:cambria;font-size:12px;"> TPP Normal</th>
<th align="center" style="font-family:cambria;font-size:12px;">Capaian Kinerja (%)</th>
<th align="center" style="font-family:cambria;font-size:12px;">Tambahan TPP</th>
<th align="center" style="font-family:cambria;font-size:12px;">Konversi Pembelaan Bulan Lalu</th>
<th align="center" style="font-family:cambria;font-size:12px;">Total Tunjangan</th>

</tr>
</thead>
<tbody>
<?php
$i = 1;
foreach ($model->detailHitungTunjangan as $detail) {
    echo '<tr>';
    echo "<td  style=\"font-family:cambria;font-size:12px;
    \">$i&nbsp;&nbsp;&nbsp;</td>";
    echo '<td style="font-family:cambria;font-size:12px;">'.$detail->pegawai->nama.'<br> NIP:'.$detail->pegawai->nip.' &nbsp;&nbsp;&nbsp;</td> ';
    echo '<td style="font-family:cambria;font-size:12px;"> '.$detail->pegawai->nama_jabatan.' '.$detail->pegawai->eselon. (is_null($detail->pegawai->jabatanTambahan)?"":"<br>(". $detail->pegawai->nama_jabatan_tambahan.')') .'&nbsp;&nbsp;&nbsp;</td> ';
    echo '<td style="font-family:cambria;font-size:12px;" align="center">'.$detail->pegawai->kode_golongan.'&nbsp;&nbsp;&nbsp;</td> ';
    echo '<td align="center" style="font-family:cambria;font-size:12px;"> '.$detail->jumlah_absen.'&nbsp;&nbsp;&nbsp;</td> ';
    echo '<td align="center" style="font-family:cambria;font-size:12px;">'.round($detail->total_jam_potong).'&nbsp;&nbsp;&nbsp;</td> ';
    echo '<td align="right" style="font-family:cambria;font-size:12px;"> '.\Yii::$app->formatter->asDecimal($detail->tunjangan_tpp2, 0).'&nbsp;&nbsp;&nbsp;</td> ';
    echo '<td align="center" style="font-family:cambria;font-size:12px;">'.\Yii::$app->formatter->asDecimal($detail->capaian_kinerja, 0).'% &nbsp;&nbsp;&nbsp;</td> ';
    echo '<td align="right" style="font-family:cambria;font-size:12px;"> '.\Yii::$app->formatter->asDecimal($detail->tambahan_tpp, 0).'&nbsp;&nbsp;&nbsp;</td> ';
    echo '<td align="right" style="font-family:cambria;font-size:12px;"> '.\Yii::$app->formatter->asDecimal($detail->total_banding, 0).'&nbsp;&nbsp;&nbsp;</td> ';
    echo '<td align="right" style="font-family:cambria;font-size:12px;"><b> ' .\Yii::$app->formatter->asDecimal($detail->total_tunjangan, 0).'&nbsp;&nbsp;&nbsp;</b></td> ';
    echo '</tr>';
    ++$i;
    $total += $detail->total_tunjangan;
} ?>

</tbody>
<tr>
  <td colspan=10 align="right"  style="font-family:cambria;font-size:12px;"> <b>Total</b> &nbsp;&nbsp;&nbsp;</td>

<?php
    echo '<td align="right" style="font-family:cambria;font-size:12px;"><b>'.\Yii::$app->formatter->asDecimal($total, 0).'</b>&nbsp;&nbsp;&nbsp;</td> ';
    ?>


</tr>
</table>
<br>

<div class="col-md-6">
<div class="header" style="margin-bottom :40px">
<div class="image" style="background:  no-repeat;  width: 250px; height: 150px; float: left;

    display: inline-block;font-family:cambria;font-size:12px;">   Verifikator Absensi<br>
        <?= $model->nama_satuan_kerja; ?>,<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>

   <b><u>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </u></b>
        <br>
        Tanggal Verifikasi : <?= \Yii::$app->formatter->asDate(date('Y-m-d'), 'long'); ?>
        </p>

</div>
<div class="image" style="background:  no-repeat;  width: 250px; height: 150px; float: right;

    display: inline-block;font-family:cambria;font-size:12px;">   Kepala Dinas <br>
        <?= $model->nama_satuan_kerja; ?>,<br>
        &nbsp;<br>
        &nbsp;<br>
        &nbsp;<br>

   <b><u>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </u></b>
        <br>
        </p>

</div>

</div>
