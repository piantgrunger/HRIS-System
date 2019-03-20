<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
 * Class m180928_035925_create_satuan_kerja.
 */
class m180928_035925_create_satuan_kerja extends Migration
{
    public function safeUp()
    {
        $this->createTable(
        'tb_m_satuan_kerja',
        [
        'id_satuan_kerja' => $this->primaryKey(),
         'nama_satuan_kerja' => $this->string(100)->notNull(),
    ]
    );

        // path tempat file csv berada
        $source = Yii::getAlias('@app/migrations/tblmastersatuankerja.csv');
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
        $row[3],
          ]
    );
        }
        $this->batchInsert('tb_m_satuan_kerja', ['id_satuan_kerja',  'nama_satuan_kerja'], $Rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(
        'tb_m_satuan_kerja');
    }

    public function down()
    {
        echo "m180928_035925_create_satuan_kerja cannot be reverted.\n";

        return false;
    }
}
