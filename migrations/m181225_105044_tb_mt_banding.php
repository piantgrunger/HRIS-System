<?php

use yii\db\Migration;

/**
 * Class m181225_105044_tb_mt_banding
 */
class m181225_105044_tb_mt_banding extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_pegawai', 'id_atasan', $this->integer());

        $this->createTable('tb_mt_banding', [
              'id_banding' => $this->primaryKey(),
              'tgl_banding' => $this->date()->notNull(),
              'id_pegawai' => $this->integer(),
               'id_atasan' => $this->integer(),
              'id_absen' => $this->integer(),
              'alasan' =>$this->text(),
              'file' => $this->string(255),
              'status_banding' => $this->string()->defaultValue('Belum Diapprove'),
        ]);
        $this->addForeignKey(
            'FK_BANDING_PEGAWAI',
        'tb_mt_banding',
        'id_pegawai',
        'tb_m_pegawai',
        'id_pegawai'
        );
        $this->addForeignKey(
            'FK_BANDING_ATASAN',
            'tb_mt_banding',
            'id_atasan',
            'tb_m_pegawai',
            'id_pegawai'
        );

        $this->addForeignKey(
            'FK_BANDING_ABSEN',
            'tb_mt_banding',
            'id_absen',
            'tb_mt_absen',
            'id_absen'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181225_105044_tb_mt_banding cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181225_105044_tb_mt_banding cannot be reverted.\n";

        return false;
    }
    */
}
