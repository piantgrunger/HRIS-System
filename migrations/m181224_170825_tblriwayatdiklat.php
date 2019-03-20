<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
 * Class m181224_170825_tblriwayatdiklat
 */
class m181224_170825_tblriwayatdiklat extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("tb_m_riwayat_diklat", [
            'id_riwayat_diklat' => $this->primaryKey(),
            'id_pegawai' => $this->integer(),
            'tgl_mulai' => $this->date(),
            'tgl_selesai' => $this->date(),

            'nama_diklat' => $this->string(255),

            'penyelenggara' => $this->string(255),
            'tempat' => $this->string(255),

            'tgl_sttp' => $this->date(),
            'no_sttp' => $this->string(100),
            'jam' => $this->float()
        ]);
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
                    $data[17],
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
            'id_pegawai' ,
            'tgl_mulai' ,
            'tgl_selesai' ,

            'nama_diklat' ,

            'penyelenggara' ,
            'tempat' ,
            'tgl_sttp',
            'no_sttp' ,
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
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181224_170825_tblriwayatdiklat cannot be reverted.\n";

        return false;
    }
    */
}
