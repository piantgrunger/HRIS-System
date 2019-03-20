<?php

use yii\db\Migration;

/**
 * Class m190106_055942_alter_tb_m_pegawai
 */
class m190106_055942_alter_tb_m_pegawai extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("tb_m_pegawai", 'file_sk_cpns', $this->string(50));
        $this->addColumn("tb_m_pegawai", 'file_sk_pns', $this->string(50));
        $this->addColumn("tb_m_pegawai", 'file_kartu_pegawai', $this->string(50));
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
        echo "m190106_055942_alter_tb_m_pegawai cannot be reverted.\n";

        return false;
    }
    */
}
