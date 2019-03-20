<?php

use yii\db\Migration;

/**
 * Class m190130_130354_createpenilaian
 */
class m190130_130354_createpenilaian extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_mt_penilaian', [
            'id_penilaian' => $this->primaryKey(),
            'bulan' => $this->integer()->notNull(),
            'tahun' => $this->integer()->notNull(),
            'orientasi_pelayanan' => $this->decimal(19, 2)->notNull(),
            'integritas' => $this->decimal(19, 2)->notNull(),
            'komitmen' => $this->decimal(19, 2)->notNull(),
            'disiplin' => $this->decimal(19, 2)->notNull(),
            'kerjasama' => $this->decimal(19, 2)->notNull(),
            'kepemimpinan' => $this->decimal(19, 2),
            'jumlah' => $this->decimal(19, 2),
            'rata_rata' => $this->decimal(19, 2),
            'status' => $this->string(100),

            'id_pegawai' => $this->integer()->notNull(),
            'id_penilai' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('FKtb_mt_penilaian_pegawai', 'tb_mt_penilaian', 'id_pegawai', 'tb_m_pegawai', 'id_pegawai', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('FK_tb_mt_penilaian_penilai', 'tb_mt_penilaian', 'id_penilai', 'tb_m_pegawai', 'id_pegawai', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tb_mt_penilaian');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190130_130354_createpenilaian cannot be reverted.\n";

        return false;
    }
    */
}
