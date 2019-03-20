<?php

use yii\db\Migration;

/**
 * Class m181022_141319_alter_tb_m_pegawai
 */
class m181022_141319_alter_tb_m_pegawai extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_pegawai', 'id_shift', $this->integer());
        $this->execute('update  tb_m_pegawai set id_shift=1');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tb_m_pegawai', 'id_shift');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181022_141319_alter_tb_m_pegawai cannot be reverted.\n";

        return false;
    }
    */
}
