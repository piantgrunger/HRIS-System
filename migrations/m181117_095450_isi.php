<?php

use yii\db\Migration;
use League\Csv\Reader;
use app\models\Pegawai;

/**
 * Class m181117_095450_isi.
 */
class m181117_095450_isi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // path tempat file csv berada
        $source = Yii::getAlias('@app/migrations/tblidentitaspegawai.csv');
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($source);
        // insert data provinsi kedalam tabel provinsi
        //cek max_allowed_packet di my.ini
        foreach ($reader as $index => $row) {
            $pegawai = Pegawai::find()->where('id_pegawai='.$row[0])->one();
            $pegawai->id_golongan = (int) $row[6];
            $pegawai->save(false);

        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181117_095450_isi cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181117_095450_isi cannot be reverted.\n";

        return false;
    }
    */
}
