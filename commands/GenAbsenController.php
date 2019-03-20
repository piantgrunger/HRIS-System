<?php

namespace app\commands;

use yii\console\Controller;
use app\models\SatuanKerja;
use app\models\Absen;
use Yii;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 *
 * @since 2.0
 */
class GenAbsenController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     *
     * @param string $message the message to be echoed
     */

    public function actionIndex()
    {
        $kemarin= new \DateTime('yesterday') ;
        $batas ='2019-02-28'; //$kemarin->format('Y-m-d');

        $satuanKerja = SatuanKerja::find()->where('tanggal_absen_terakhir is not null ')->all();
        foreach ($satuanKerja as $model) {
            $modelAbsen = Absen::find()
            ->innerJoin("tb_m_pegawai", "tb_m_pegawai.id_pegawai = tb_mt_absen.id_pegawai and id_satuan_kerja=". $model->id_satuan_kerja)
           ->innerJoin("tb_m_jenis_absen", "tb_m_jenis_absen.id_jenis_absen = tb_mt_absen.id_jenis_absen and nama_jenis_absen='Masuk'")
            ->where("tgl_absen<= '". $batas."' ")->orderBy("tgl_absen desc")->one();
            if (!is_null($modelAbsen)) {
                $tgl = explode('-', $modelAbsen ->tgl_absen);
                $tgl_awal = $tgl[0].'-'.$tgl[1].'-1';
                $tgl_akhir = $modelAbsen->tgl_absen;

                $connection = Yii::$app->getDb();
                $command = $connection->createCommand("call `generate_absen`('$tgl_awal', '$tgl_akhir', '$model->id_satuan_kerja')");
                $command->execute();
                echo "$tgl_awal', '$tgl_akhir', '$model->nama_satuan_kerja \n ";
            }
        }
    }
}
