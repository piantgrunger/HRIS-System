<?php

use yii\db\Migration;

/**
 * Class m190106_120023_skp_tugas_belajar
 */
class m190106_120023_skp_tugas_belajar extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("tb_m_pegawai", 'file_sp_tugas_belajar', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190106_120023_skp_tugas_belajar cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190106_120023_skp_tugas_belajar cannot be reverted.\n";

        return false;
    }
    */
}
