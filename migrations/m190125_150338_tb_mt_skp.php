<?php

use yii\db\Migration;

/**
 * Class m190125_150338_tb_mt_skp
 */
class m190125_150338_tb_mt_skp extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_mt_skp', [
                'id_skp' => $this->primaryKey(),
                'id_pegawai' => $this->integer()->notNull(),
                'id_penilai' => $this->integer()->notNull(),
                'uraian_tugas' => $this->text()->notNull(),
                'angka_kredit' => $this->decimal(19, 2),
                'kuantitas' => $this->integer()->notNull(),
                'satuan_kuantitas' => $this->string()->notNull(),
                'waktu' => $this->integer()->notNull(),
                'satuan_waktu' => $this->string()->notNull(),
               'biaya' => $this->decimal(19, 2),
               'tahun' => $this->integer()->notNull(),
            ]);

        $this->createTable('tb_dt_skp', [
            'id_d_skp' => $this->primaryKey(),
            'id_skp' => $this->integer()->notNull(),
            'bulan' => $this->integer()->notNull(),
            'kuantitas' => $this->integer()->notNull(),

        ]);

        $this->addForeignKey('FK_tb_dt_skp', 'tb_dt_skp', 'id_skp', 'tb_mt_skp', 'id_skp', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_tb_mt_skp_pegawai', 'tb_mt_skp', 'id_pegawai', 'tb_m_pegawai', 'id_pegawai', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('FK_tb_mt_skp_penilai', 'tb_mt_skp', 'id_penilai', 'tb_m_pegawai', 'id_pegawai', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190125_150338_tb_mt_skp cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190125_150338_tb_mt_skp cannot be reverted.\n";

        return false;
    }
    */
}
