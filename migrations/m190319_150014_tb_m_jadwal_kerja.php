<?php

use yii\db\Migration;

/**
 * Class m190319_150014_tb_m_jadwal_kerja
 */
class m190319_150014_tb_m_jadwal_kerja extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_m_jadwal_kerja', [
                'id_jadwal' => $this->primaryKey(),
                'id_satuan_kerja' =>$this->integer()->notNull(),
                'tanggal_awal' => $this->date()->notNull(),
                'tanggal_akhir' => $this->date()->notNull(),
                'keterangan' =>$this->text(),

            ]);
        $this->addForeignKey('fk_jadwal_satuan_kerja', 'tb_m_jadwal_kerja', 'id_satuan_kerja', 'tb_m_satuan_kerja', 'id_satuan_kerja');
        $this->createTable('tb_d_jadwal_kerja', [
            'id_d_jadwal' => $this->primaryKey(),
            'id_jadwal' => $this->integer()->notNull(),

            'id_pegawai' =>$this ->integer()->notNull(),
            'tanggal' => $this->date()->notNull(),
            'jam_masuk' => $this->time()->notNull(),
            'jam_pulang' => $this->time()->notNull(),

            ]);
        $this->addForeignKey('fk_jadwal_detail', 'tb_d_jadwal_kerja', 'id_jadwal', 'tb_m_jadwal_kerja', 'id_jadwal', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_jadwal_pegawai', 'tb_d_jadwal_kerja', 'id_pegawai', 'tb_m_pegawai', 'id_pegawai');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tb_d_jadwal_kerja');
        $this->dropTable('tb_m_jadwal_kerja');
        
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190319_150014_tb_m_jadwal_kerja cannot be reverted.\n";

        return false;
    }
    */
}
