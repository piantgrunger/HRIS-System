<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
 * Class m180915_211020_tb_m_jabatan_fungional.
 */
class m180915_211020_tb_m_jabatan_fungional extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'tb_m_jabatan_fungsional',
            [
            'id_jabatan_fungsional' => $this->primaryKey(),
            'kode_jabatan_fungsional' => $this->string(50)->notNull(),
            'nama_jabatan_fungsional' => $this->string(100)->notNull(),
            'ruang_awal' => $this->string(4)->notNull(),
            'ruang_akhir' => $this->string(4)->notNull(),
        ]
        );

        // path tempat file csv berada
        $source = Yii::getAlias('@app/migrations/refmasterjabatanfungsional.csv');
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
              ]
        );
        }
        $this->batchInsert('tb_m_jabatan_fungsional', ['id_jabatan_fungsional', 'kode_jabatan_fungsional', 'nama_jabatan_fungsional', 'ruang_awal', 'ruang_akhir'], $Rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(
            'tb_m_jabatan_fungsional'
                );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180915_211020_tb_m_jabatan_fungional cannot be reverted.\n";

        return false;
    }
    */
}
