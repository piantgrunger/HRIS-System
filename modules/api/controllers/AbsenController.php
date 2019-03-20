<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\Controller;
use app\models\Pegawai;
use app\models\JenisAbsen;
use app\models\Absen;
use app\models\DetShift;
use app\models\Ijin;
use app\models\SatuanKerja;

/**
 * Default controller for the `api` module.
 */
class AbsenController extends Controller
{
    public function actionIndex()
    {
        $start = date('Y-m-d h:i:s a', time());
        $request = Yii::$app->request;
        $tanggal = $request->post('tanggal');
        $waktu = $request->post('waktu');
        $jenis = $request->post('jenis');
        $id_skpd = $request->post('id_skpd');
        $satuanKerja = SatuanKerja::findOne($id_skpd);

        $kode_checklog = $request->post('kode_checklog');
        $pegawai = Pegawai::find()
            ->leftJoin('tb_m_satuan_kerja', 'tb_m_satuan_kerja.id_satuan_kerja = tb_m_pegawai.id_satuan_kerja')
              ->where(['kode_checklog' => $kode_checklog])
             ->andWhere(['checklog_key' => $satuanKerja->checklog_key])
            ->one();

        if (is_null($pegawai)) {
            $finish = date('Y-m-d h:i:s a', time());
            return ['status' => 404, 'start' => $start, 'finish' => $finish];
        }
        $hari =  date('w', strtotime($tanggal))-1;
        $shift = DetShift::find()->where(['id_shift' => $pegawai->id_shift, 'hari' => $hari])->one();

        if (!is_null($shift)) {
        //die(print_r($shift->jam_masuk . $shift->jam_pulang));
            if (strtotime($shift->jam_masuk) > strtotime($shift->jam_pulang)) {
                $jam_kerja =  (24*3600) - ((strtotime($shift->jam_pulang) - strtotime($shift->jam_masuk)));
            } else {
                $jam_kerja =  ((strtotime($shift->jam_pulang) - strtotime($shift->jam_masuk)));

            }
                
            if (strtotime($waktu) <= (strtotime($shift->jam_masuk) + $jam_kerja/2)) {
                $jenis = 'masuk_kerja';
            } else {
                $jenis = 'pulang_kerja';
            }
        } else {
        
            $jenis = 'masuk_kerja';
        }




        $absen = Absen::find()->where(['id_pegawai' => $pegawai->id_pegawai])->andWhere(['tgl_absen' =>$tanggal])->one();
  //      die(var_dump($absen->tgl_absen));

        $jnsAbsen = Ijin::find()->where(['id_pegawai' => $pegawai->id_pegawai])->andWhere(['tgl_absen' => $tanggal])->one();
        if (is_null($jnsAbsen)) {
            $jnsAbsen = JenisAbsen::find()->where("nama_jenis_absen = 'Masuk' ")->one();
        }
        if (is_null($absen)) {
            $absen = new Absen();
        //   $absen->tgl_absen =implode('-', array_reverse(explode('-', $tanggal)));
        }
         //  die(var_dump($absen->tgl))

        $absen->id_jenis_absen = $jnsAbsen->id_jenis_absen;

        $absen->id_pegawai = $pegawai->id_pegawai;
        $absen->attributes = [$jenis => $waktu];
         $absen->tgl_absen =implode('-', array_reverse(explode('-', $tanggal)));


        $finish = date('Y-m-d h:i:s a', time());
        // if ($absen->tgl_absen !='0000-00-00') {
        //     \Yii::$app->db->createCommand("update tb_m_satuan_kerja set tanggal_absen_terakhir = '".$absen->tgl_absen ."' where id_satuan_kerja=$id_skpd and coalesce(tanggal_absen_terakhir,'1990-1-1') < '".$absen->tgl_absen ."'")->execute();
        // }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($absen->save()) {
            $data = ['status' => 200, 'start' => $start, 'finish' => $finish,'tanggal'=> $absen->tgl_absen,
            'kode_checklog' => $kode_checklog,'masuk_kerja' =>$absen->masuk_kerja,'pulang_kerja' =>$absen->pulang_kerja,'karyawan' =>$absen->nama_pegawai];
        } else {
            $data = ['status' => 404, 'start' => $start, 'finish' => $finish];
        }
        return $data;
    }
}
