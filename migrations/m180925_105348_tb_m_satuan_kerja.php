<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
 * Class m180925_105348_tb_m_unit_kerja.
 */
class m180925_105348_tb_m_satuan_kerja extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'tb_m_unit_kerja',
            [
            'id_unit_kerja' => $this->primaryKey(),
            'kode_unit_kerja' => $this->string(50)->notNull(),
            'nama_unit_kerja' => $this->string(100)->notNull(),
        ]
        );

        // path tempat file csv berada
        $source = Yii::getAlias('@app/migrations/tblmasterunitkerja.csv');
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
            $row[12],
             $row[3],
              ]
        );
        }
        $this->batchInsert('tb_m_unit_kerja', ['id_unit_kerja', 'kode_unit_kerja', 'nama_unit_kerja'], $Rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(
            'tb_m_unit_kerja');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180925_105348_tb_m_unit_kerja cannot be reverted.\n";

        return false;
    }
    */
}
