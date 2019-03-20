<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
 * Class m180925_101417_tb_m_jbtn_fungsional_umum_umum.
 */
class m180925_101417_tb_m_jbtn_fungsional_umum extends Migration
{
    public function safeUp()
    {
        $this->createTable(
        'tb_m_jabatan_fungsional_umum',
        [
        'id_jabatan_fungsional_umum' => $this->primaryKey(),
        'kode_jabatan_fungsional_umum' => $this->string(50)->notNull(),
        'nama_jabatan_fungsional_umum' => $this->string(100)->notNull(),
        'besaran_tpp' => $this->decimal(19, 2),
        'tambahan_tunjangan_kinerja' => $this->decimal(19, 2),
    ]
    );

        // path tempat file csv berada
        $source = Yii::getAlias('@app/migrations/refmasterjabatanfungsionalumum.csv');
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
          ]
    );
        }
        $this->batchInsert('tb_m_jabatan_fungsional_umum', ['id_jabatan_fungsional_umum', 'kode_jabatan_fungsional_umum', 'nama_jabatan_fungsional_umum'], $Rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(
        'tb_m_jabatan_fungsional_umum'
            );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180925_101417_tb_m_jbtn_fungsional_umum_umum cannot be reverted.\n";

        return false;
    }
    */
}
