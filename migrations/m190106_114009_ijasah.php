<?php

use yii\db\Migration;

/**
 * Class m190106_114009_ijasah
 */
class m190106_114009_ijasah extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("tb_m_pegawai", 'file_ijazah', $this->string(10000));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190106_114009_ijasah cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190106_114009_ijasah cannot be reverted.\n";

        return false;
    }
    */
}
