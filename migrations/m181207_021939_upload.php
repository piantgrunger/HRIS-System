<?php

use yii\db\Migration;
use League\Csv\Reader;
use app\models\JabatanFungsional;

/**
 * Class m181207_021939_upload.
 */
class m181207_021939_upload extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $source = Yii::getAlias('@app/migrations/ptt.csv');
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($source);
        $row = [];
        foreach ($reader as $index => $data) {
            $jabatan = JabatanFungsional::find()->where("nama_jabatan_fungsional= '".$data[7]."'")->one();
            if (is_null($jabatan)) {
                $jabatan = new JabatanFungsional();
                $jabatan->nama_jabatan_fungsional = $data[7];
                $jabatan->status_jabatan = 'Fungsional Tertentu';
                $jabatan->save(false);
            }
            $tgl = explode('/', $data[4]);
            if (sizeof($tgl) >= 3) {
                $tanggal = $tgl[2].'-'.$tgl[0].'-'.$tgl[1];
            } else {
                $tanggal = null;
            }
            array_push(
                $row,
                [
                    $data[0],
                    $data[1],
                    $data[2],
                    $data[3],
                   $tanggal, //  $data[4],
                    $jabatan->id_jabatan_fungsional,
                    $data[8],
                ]
            );
        }
        $this->batchInsert('tb_m_pegawai', ['nama', 'nip', 'jenis_pegawai', 'tempat_lahir', 'tanggal_lahir', 'id_jabatan_fungsional', 'id_satuan_kerja'], $row);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181207_021939_upload cannot be reverted.\n";

        return false;
    }
    */
}
