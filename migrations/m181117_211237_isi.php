<?php

use yii\db\Migration;
use League\Csv\Reader;
use app\models\JabatanFungsional;

/**
 * Class m181117_211237_isi.
 */
class m181117_211237_isi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // path tempat file csv berada
        $source = Yii::getAlias('@app/migrations/tblmasterjabatan.csv');
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($source);
        // insert data provinsi kedalam tabel provinsi
        //cek max_allowed_packet di my.ini
        foreach ($reader as $index => $row) {
            if ($row[2] !== 'NULL') {
                $jabatan = JabatanFungsional::find()->where('id_jabatan_fungsional='.$row[0])->one();
                $jabatan->id_eselon = (int) $row[2];
                $jabatan->save(false);
                echo $jabatan->nama_jabatan_fungsional."\n";
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181117_211237_isi cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181117_211237_isi cannot be reverted.\n";

        return false;
    }
    */
}
