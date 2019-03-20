<?php

namespace app\helpers;

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\HariLibur;
use app\models\Pegawai;
use app\models\DetShift;

class myhelpers
{
    public static function isLibur($tgl, $idPegawai)
    {
        $pegawai=Pegawai::findOne($idPegawai);
        $hari = date('w', strtotime($tgl)) -1;
        $shift = DetShift::find()->where(['id_shift' => $pegawai->id_shift, 'hari' => $hari])->one();
        if (is_null($shift)) {
            return true;
        }
        $libur=HariLibur::find()->where(['tanggal_libur' =>$tgl])->one();
        return (!is_null($libur) || ($shift->jam_masuk=="00:00:00" && $shift->jam_pulang=="00:00:00"));
    }


    public static function populateLink($field, $delimiter, $title, $dir)
    {
        $v="";
        $i=1;
        $links = explode($delimiter, $field);
        foreach ($links as $link) {
            if ($link !=="") {
                $v .= Html::a("$title - ".$i, Url::to([$dir.$link]))."<br>";
                $i++;
            }
        }
        return $v;
    }
    public static function getMonth($month)
    {
        $bulan = [
           1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
         ];

        return $bulan[$month];
    }

    public static function getMonths()
    {
        return [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
    }
}
