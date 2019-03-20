<?php

use yii\db\Migration;
use League\Csv\Reader;
use app\models\JabatanFungsional;

/**
 * Class m181117_102557_alterjabatan.
 */
class m181117_102557_alterjabatan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_jabatan_fungsional', 'status_jabatan', $this->string());
        // path tempat file csv berada
        $source = Yii::getAlias('@app/migrations/tblmasterjabatan.csv');
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($source);
        // insert data provinsi kedalam tabel provinsi
        //cek max_allowed_packet di my.ini
        $Rows = array();
        foreach ($reader as $index => $row) {
            if ($row[10] == '2') {
                $stat = 'Struktural';
            } elseif ($row[10] == '2') {
                $stat = 'Fungsional Tertentu';
            } else {
                $stat = 'Fungsional Umum';
            }

            $jabatan = JabatanFungsional::find()->where('id_jabatan_fungsional='.$row[0])->one();
            $jabatan->status_jabatan = $stat;
            $jabatan->save(false);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181117_102557_alterjabatan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181117_102557_alterjabatan cannot be reverted.\n";

        return false;
    }
    */
}
