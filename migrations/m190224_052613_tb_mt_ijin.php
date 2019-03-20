<?php

use yii\db\Migration;

/**
 * Class m190224_052613_tb_mt_ijin
 */
class m190224_052613_tb_mt_ijin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_mt_ijin', [
            'id_ijin' => $this->primaryKey(),
            'id_jenis_absen' => $this->integer()->notNull(),
            'id_absen' => $this->integer(),
            'id_pegawai' => $this->integer()->notNull(),

            'tgl_absen' => $this->date()->notNull(),
            'alasan' => $this->text()->notNull(),
            'file_pendukung' => $this->string(100),
            'status' => $this->string(100)
        ]);
        $this->addForeignKey(
            'fk_ijin_jenis_absen',
            'tb_mt_ijin',
            'id_jenis_absen',
            'tb_m_jenis_absen',
            'id_jenis_absen',
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_ijin_pegawai',
            'tb_mt_ijin',
            'id_pegawai',
            'tb_m_pegawai',
            'id_pegawai',
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_ijin_absen',
            'tb_mt_ijin',
            'id_absen',
            'tb_mt_absen',
            'id_absen',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tb_mt_ijin');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190224_052613_tb_mt_ijin cannot be reverted.\n";

        return false;
    }
    */
}
