<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
 * Class m180928_042122_alter_jabatan.
 */
class m180928_042122_alter_jabatan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'tb_m_jabatan_fungsional',
             'id_unit_kerja',
             $this->integer()
         );

        $this->addColumn(
            'tb_m_jabatan_fungsional',
           'id_satuan_kerja',
           $this->integer()
       );
        $this->dropColumn(
        'tb_m_jabatan_fungsional',
     'kode_jabatan_fungsional'
   );
        $this->truncateTable('tb_m_jabatan_fungsional');

        // path tempat file csv berada
        $source = Yii::getAlias('@app/migrations/tblmasterjabatan.csv');
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
             $row[9],

                   $row[3],
                   $row[4],
               ]
         );
        }
        $this->batchInsert('tb_m_jabatan_fungsional', ['id_jabatan_fungsional',  'nama_jabatan_fungsional', 'id_unit_kerja', 'id_satuan_kerja'], $Rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(
            'tb_m_jabatan_fungsional',
             'id_unit_kerja'
         );

        $this->dropColumn(
            'tb_m_jabatan_fungsional',
           'id_satuan_kerja'
       );
        $this->addColumn(
        'tb_m_jabatan_fungsional',
     'kode_jabatan_fungsional',
     $this->string()
   );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180928_042122_alter_jabatan cannot be reverted.\n";

        return false;
    }
    */
}
