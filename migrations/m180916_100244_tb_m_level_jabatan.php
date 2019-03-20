<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
 * Class m180916_100244_tb_m_level_jabatan.
 */
class m180916_100244_tb_m_level_jabatan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'tb_m_level_jabatan',
            [
            'id_level_jabatan' => $this->primaryKey(),
            'nama_level_jabatan' => $this->string(100)->notNull(),
            'kelas_level_jabatan' => $this->integer()->notNull(),
            'nilai_jabatan' => $this->decimal(19, 2)->notNull(),
            'ikkd' => $this->decimal(19, 2)->notNull(),
            'tpp_dinamis' => $this->decimal(19, 2)->notNull(),
            'tpp_statis' => $this->decimal(19, 2)->notNull(),
        ]
        );

        // path tempat file csv berada
        $source = Yii::getAlias('@app/migrations/leveljabatan.csv');
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($source);
        // insert data provinsi kedalam tabel provinsi
        //cek max_allowed_packet di my.ini
        $Rows = array();
        foreach ($reader as $index => $row) {
            array_push(
                $Rows,
                [
            $row[0],
             $row[1],
             $row[2],
             $row[3],
             $row[4],
             $row[5],
              ]
        );
        }
        $this->batchInsert('tb_m_level_jabatan', ['nama_level_jabatan', 'kelas_level_jabatan', 'nilai_jabatan', 'ikkd', 'tpp_statis', 'tpp_dinamis'], $Rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(
            'tb_m_level_jabatan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180916_100244_tb_m_level_jabatan cannot be reverted.\n";

        return false;
    }
    */
}
