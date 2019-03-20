<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HitungTunjangan */

$this->title = 'Perhitungan Tunjangan ';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daftar Hitung Tunjangan'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$total = 0;
?>
<div class="hitung-tunjangan-view">

    <h3><?= Html::encode($this->title); ?></h3>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tgl_awal:date',
            'tgl_akhir:date',
            'nama_satuan_kerja',
        ],
    ]); ?>
    <div class="panel panel-info">
        <div class="panel-heading"><b> Data Pegawai</b></div>
        <div class="panel-body">

            <table class="table table-bordered  ">
                <tr class="bg-primary">
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Eselon</th>
                    <th>Golongan</th>
                    <th>Jumlah Absen</th>
                    <th>Potongan Terlambat (Jam)</th>
                    <th>Tunjangan TPP</th>
                    <th>Capaian Kinerja (%)</th>
                    <th align="center">Konversi Pembelaan Bulan Lalu</th>

                    <th>Tambahan TPP</th>

                    <th>Total Tunjangan</th>
                    <th>Keterangan</th>
                </tr>

                <?php foreach ($model->detailHitungTunjangan as $detail) {
        echo '<tr>';
        echo '<td>' . $detail->pegawai->nama . ' </td> ';
        echo '<td> ' . $detail->pegawai->nama_jabatan . '</td> ';
        echo '<td> ' . $detail->pegawai->eselon . '</td> ';
        echo '<td>' . $detail->pegawai->kode_golongan . '</td> ';
        echo '<td> ' . $detail->jumlah_absen . '</td> ';
        echo '<td>' . $detail->total_jam_potong . '</td> ';
        echo '<td align="right"> ' . \Yii::$app->formatter->asDecimal($detail->tunjangan_tpp2, 0) . '</td> ';
        echo '<td align="right">' . \Yii::$app->formatter->asDecimal($detail->capaian_kinerja, 0) . '% </td> ';
        echo '<td align="right"> ' . \Yii::$app->formatter->asDecimal($detail->total_banding, 0) . '</td> ';

        echo '<td align="right"> ' . \Yii::$app->formatter->asDecimal($detail->tambahan_tpp, 0) . '</td> ';

        echo '<td align="right">' . \Yii::$app->formatter->asDecimal($detail->total_tunjangan, 0) . '</td> ';
        echo '<td>' . $detail->keterangan . ' </td> ';

        echo '</tr>';
        $total += $detail->total_tunjangan;
    } ?>


                <tr>
                    <td colspan=10 align="right"> <b>Total</b> </td>
                    <?php echo '<td align="right">' . \Yii::$app->formatter->asDecimal($total, 0) . '</td> ';
                    ?>
                    <td></td>
                </tr>
            </table>

        </div>
    </div>
</div>