<?php

use yii\db\Migration;

/**
 * Class m190106_140824_skp
 */
class m190106_140824_skp extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("tb_m_pegawai", 'file_sp_tugas', $this->text());
        $this->addColumn("tb_m_pegawai", 'file_angka_kredit', $this->text());
        $this->addColumn("tb_m_pegawai", 'file_sk_kenaikan_jabatan', $this->text());
        $this->addColumn("tb_m_pegawai", 'file_sk_kenaikan_gaji_berkala', $this->text());
        $this->addColumn("tb_m_pegawai", 'transkrip_nilai', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190106_140824_skp cannot be reverted.\n";

        return false;
    }
    */
}
