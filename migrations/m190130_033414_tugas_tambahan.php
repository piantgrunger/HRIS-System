<?php

use yii\db\Migration;

/**
 * Class m190130_033414_tugas_tambahan.
 */
class m190130_033414_tugas_tambahan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_mt_tugas_tambahan', [
            'id_tugas_tambahan' => $this->primaryKey(),
            'bulan' => $this->integer()->notNull(),
            'tahun' => $this->integer()->notNull(),
            'uraian_tugas' => $this->text()->notNull(),
            'file_pendukung' => $this->string(300),
            'status' => $this->string()->notNull(),
            'id_pegawai' => $this->integer()->notNull(),
            'id_penilai' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('FKtb_mt_tugas_tambahan_pegawai', 'tb_mt_tugas_tambahan', 'id_pegawai', 'tb_m_pegawai', 'id_pegawai', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('FK_tb_mt_tugas_tambahan_penilai', 'tb_mt_tugas_tambahan', 'id_penilai', 'tb_m_pegawai', 'id_pegawai', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190130_033414_tugas_tambahan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190130_033414_tugas_tambahan cannot be reverted.\n";

        return false;
    }
    */
}
