<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
 * Class m181225_041353_diklat
 */
class m181225_041353_diklat extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->truncateTable('tb_m_riwayat_diklat');
        $source = Yii::getAlias('@app/migrations/tblriwayatdiklat.csv');
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($source);
        $row = [];
        foreach ($reader as $index => $data) {
            array_push(
                $row,
                [
                    $data[0],
                    $data[1],
                    $data[6],
                    $data[7],
                   ($data[17]=="NULL")? $data[22]: $data[17],
                    $data[8],
                    $data[9],

                    $data[12],
                    $data[11],
                    $data[10],

                ]
            );

            echo $data[6] . '-';
        }
        try {
            $this->batchInsert('tb_m_riwayat_diklat', [
                'id_riwayat_diklat',
                'id_pegawai',
                'tgl_mulai',
                'tgl_selesai',

                'nama_diklat',

                'penyelenggara',
                'tempat',
                'tgl_sttp',
                'no_sttp',
                'jam'
            ], $row);
        } catch (Exception $ex) {
            echo 'Query failed ' . substr($ex->getMessage(), 1, 1000);
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181225_041353_diklat cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181225_041353_diklat cannot be reverted.\n";

        return false;
    }
    */
}
