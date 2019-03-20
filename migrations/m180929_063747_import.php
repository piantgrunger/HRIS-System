<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
 * Class m180929_063747_import.
 */
class m180929_063747_import extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey(
            'fk-pegawaiunitkerja', 'tb_m_pegawai');
        $this->dropForeignKey(
                'fk-pegawaijabatankerja', 'tb_m_pegawai');

        // path tempat file csv berada
        $source = Yii::getAlias('@app/migrations/tblidentitaspegawai.csv');
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
     $row[47].'',

     $row[53].'',
     $row[11].'',
     $row[12].'',
     $row[13],
     $row[30],
     $row[4],
     $row[7],
     $row[16],
     $row[14],
     $row[15],
         ]
   );
        }

        try {
            $this->batchInsert('tb_m_pegawai', ['id_pegawai',  'nip', 'nik', 'nama',
  'gelar_depan',
  'gelar_belakang',
  'alamat',
  'id_unit_kerja',
  'id_jabatan_fungsional',
  'jenis_kelamin',
  'tempat_lahir',
  'tanggal_lahir',
], $Rows);
        } catch (Exception $ex) {
            echo  'Query failed '.substr($ex->getMessage(), 1, 1000);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('tb_m_pegawai');
        $this->addForeignKey(
            'fk-pegawaiunitkerja',
            'tb_m_pegawai',
            'id_unit_kerja',
            'tb_m_unit_kerja',
            'id_unit_kerja',
            'RESTRICT',
            'CASCADE'
            );

        $this->addForeignKey(
                'fk-pegawaijabatankerja',
                'tb_m_pegawai',
                'id_jabatan_fungsional',
                'tb_m_jabatan_fungsional',
                'id_jabatan_fungsional',
                'RESTRICT',
                'CASCADE'
                );

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180929_063747_import cannot be reverted.\n";

        return false;
    }
    */
}
