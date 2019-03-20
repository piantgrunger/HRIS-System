<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
 * Class m180928_075741_create_pegawai.
 */
class m180928_075741_create_pegawai extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_m_pegawai', [
            'id_pegawai' => $this->PrimaryKey(),
            'nip' => $this->string(18),
            'nik' => $this->string(50),
            'nama' => $this->string()->notNull(),
            'gelar_depan' => $this->string(18),
            'gelar_belakang' => $this->string(18),
            'alamat' => $this->text()->notNull(),
            'id_unit_kerja' => $this->integer(),
            'id_jabatan_fungsional' => $this->integer(),
            'jenis_kelamin' => $this->string()->notNull(),
            'tempat_lahir' => $this->string()->notNull(),
            'tanggal_lahir' => $this->date()->notNull(),
        ]);

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

        /*
        // path tempat file csv berada
        $source = Yii::getAlias('@app/migrations/tblidentitaspegawai1.csv');
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
             (string) $row[47],

             (string) $row[53],
           $row[11],
           $row[12],
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
    */
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tb_m_pegawai');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180928_075741_create_pegawai cannot be reverted.\n";

        return false;
    }
    */
}
