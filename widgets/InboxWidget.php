<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\View;
use hscstudio\mimin\components\Mimin;
use app\models\Absen;
use app\models\Banding;
use app\models\Ijin;
use app\models\Validasi;

class InboxWidget extends Widget
{
    private $inbox;


    public function run()
    {
        $inbox=[];

        if (Mimin::checkRoute('ijin/index')) {
            $dataIjin = \app\models\Ijin::find()->where(['status' =>'Belum Divalidasi'])->count();
            if ($dataIjin >0) {
                $inbox[] = ["message"=>"Ada ".$dataIjin." data ijin yang belum divalidasi" ,"link" =>["ijin/index"]];
            }
        }

        if (Mimin::checkRoute('absen/index') && !is_null(Yii::$app->user->identity->id_pegawai)) {
            $jmlTerlambat = Absen::find()
               ->where(['id_pegawai' => Yii::$app->user->identity->id_pegawai])
               ->andWhere(['or',['>','terlambat_kerja',0] ,['>','pulang_awal',0]])
               ->andWhere(new \yii\db\Expression("month(tgl_absen)=".date('m')))
              ->andWhere(new \yii\db\Expression("year(tgl_absen)=".date('Y')))
               ->count();
            if ($jmlTerlambat>0) {
                $inbox[] = ["message"=>"Ada ".$jmlTerlambat." absensi terlambat bulan ini" ,"link" =>["absen/index"]];
            }
        }

        if (Mimin::checkRoute('hitung-tunjangan/index') && !is_null(Yii::$app->user->identity->id_satuan_kerja)) {
            $jmlValidasi = Validasi::find()
               ->where(['id_satuan_kerja' => Yii::$app->user->identity->id_satuan_kerja])
               ->andWhere(["periode" => date("m-Y", strtotime("first day of previous month"))])
               ->count();
            if ($jmlValidasi>0) {
                $inbox[] = ["message"=>" Daftar Absensi Periode ".date("m-Y", strtotime("first day of previous month"))." telah di Validasi. Saat ini anda bisa mencetak Daftar tunjangan, Daftar Absensi dan Rekapitulasi Absensi." ,"link" =>["hitung-tunjangan/index"]];
            }
        }

        if (Mimin::checkRoute('banding/index') && (Yii::$app->user->identity->is_atasan)) {
            $jmlBanding = Banding::find()->where(['id_atasan' => Yii::$app->user->identity->id_pegawai, 'status_banding' => 'Belum Diapprove'])
            ->count();

            if ($jmlBanding>0) {
                $inbox[] = ["message"=>"Ada ".$jmlBanding." data keberatan absensi yang belum diapprove" ,"link" =>["banding/index"]];
            }
        }



        Yii::$app->params["inbox"] = $inbox;
    }
}
