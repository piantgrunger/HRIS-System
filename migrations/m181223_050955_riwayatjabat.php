<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
 * Class m181223_050955_riwayatjabat.
 */
class m181223_050955_riwayatjabat extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //     $this->createTable("tb_m_riwayat_jabatan", [
    //             'id_riwayat_jabatan' =>$this->primaryKey(),
    //             'id_pegawai' => $this->integer(),
    //             'id_jabatan' => $this->integer(),
    //             'nama_jabatan' => $this->string(255),

    //               'unit_kerja' => $this->string(255),
    //             'tmt' => $this->date(),
    //             'no_sk' =>$this->string(100),
    //             'pejabat' =>$this->string(100)
    //         ]);

    //     $source = Yii::getAlias('@app/migrations/tblriwayatjabatan.csv');
    //     // baca file csv menggunakan library league\csv
    //     $reader = Reader::createFromPath($source);
    //     $row = [];
    //     foreach ($reader as $index => $data) {
    //         array_push(
    //             $row,
    //             [
    //                 $data[0],
    //                 $data[1],
    //                 $data[2],
    //                 $data[3],
    //                 $data[4],

    //                 $data[5],
    //                 $data[6],
    //                 $data[8],

    //             ]
    //         );

    //         echo $data[2] . '-';
    //     }
    //     $this->batchInsert('tb_m_riwayat_jabatan', [
    //         'id_riwayat_jabatan',
    //         'id_pegawai',
    //         'id_jabatan',

    //         'nama_jabatan',
    //         'unit_kerja',
    //         'tmt',
    //         'no_sk',
    //         'pejabat'
    //     ], $row);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tb_m_riwayat_jabatan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181223_050955_riwayatjabat cannot be reverted.\n";

        return false;
    }
    */
}
