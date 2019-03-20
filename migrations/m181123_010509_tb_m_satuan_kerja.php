<?php

use yii\db\Migration;

/**
 * Class m181123_010509_tb_m_satuan_kerja
 */
class m181123_010509_tb_m_satuan_kerja extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_pegawai', 'id_satuan_kerja', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181123_010509_tb_m_satuan_kerja cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181123_010509_tb_m_satuan_kerja cannot be reverted.\n";

        return false;
    }
    */
}
