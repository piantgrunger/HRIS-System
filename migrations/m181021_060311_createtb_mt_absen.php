<?php

use yii\db\Migration;

/**
 * Class m181021_060311_createtb_mt_absen
 */
class m181021_060311_createtb_mt_absen extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_mt_absen', [
            'id_absen' => $this->primaryKey(),
            'id_jenis_absen' => $this->integer()->notNull(),
            'id_pegawai' => $this ->integer()->notNull(),
            'tgl_absen' => $this->date(),
            'masuk_kerja' => $this->time(),
            'pulang_kerja' => $this->time(),
            'terlambat_kerja' => $this->decimal(5, 4),
            'pulang_awal' => $this->decimal(5, 4),




        ]);
        $this->addForeignKey(
            'fk-kry-absen',
            'tb_mt_absen',
            'id_pegawai',
            'tb_m_pegawai',
            'id_pegawai',
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-Jenis-absen',
            'tb_mt_absen',
            'id_jenis_absen',
            'tb_m_jenis_absen',
            'id_jenis_absen',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //    $this->dropTable('tb_mt_absen');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181021_060311_createtb_mt_absen cannot be reverted.\n";

        return false;
    }
    */
}
