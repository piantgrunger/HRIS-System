<?php

use yii\db\Migration;
use League\Csv\Reader;
use app\models\Pegawai;

/**
 * Class m181123_012122_ins
 */
class m181123_012122_ins extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $source = Yii::getAlias('@app/migrations/tblidentitaspegawai.csv');
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($source);
        // insert data provinsi kedalam tabel provinsi
        //cek max_allowed_packet di my.ini

        foreach ($reader as $index => $row) {
            $pegawai = Pegawai::find()->where(["id_pegawai" => $row[0]])->one();
            $pegawai->id_satuan_kerja = (int)$row[44];
            $pegawai->save(false);
            echo $pegawai->nama ."-". $row[44];
        }
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
        echo "m181123_012122_ins cannot be reverted.\n";

        return false;
    }
    */
}
