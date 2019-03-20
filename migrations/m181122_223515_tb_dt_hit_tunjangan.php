<?php

use yii\db\Migration;

/**
 * Class m181122_223515_tb_dt_hit_tunjangan
 */
class m181122_223515_tb_dt_hit_tunjangan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_dt_hitung_tunjangan', [
            'id_d_hitung_tunjangan' =>$this->primaryKey(),
            'id_hitung_tunjangan' => $this->integer(),
            'id_pegawai' =>$this->integer(),
            'jumlah_absen' => $this->integer(),
            'total_jam_potong' =>$this->decimal(19, 2),
            'tunjangan_tpp' =>$this->decimal(19, 2),
            'capaian_kinerja' => $this->decimal(19, 2),
            'tambahan_tpp' => $this->decimal(19, 2),
            'total_tunjangan' => $this->decimal(19, 2),
        ]);
        $this->addForeignKey(
            'fk_ht_dt',
            'tb_dt_hitung_tunjangan',
            'id_hitung_tunjangan',
            'tb_mt_hitung_tunjangan',
            'id_hitung_tunjangan',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_ht_dt_pegawai',
            'tb_dt_hitung_tunjangan',
            'id_pegawai',
            'tb_m_pegawai',
            'id_pegawai',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181122_223515_tb_dt_hit_tunjangan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181122_223515_tb_dt_hit_tunjangan cannot be reverted.\n";

        return false;
    }
    */
}
