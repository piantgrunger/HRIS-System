<?php

use yii\db\Migration;

/**
 * Class m190328_065816_alterlembur
 */
class m190328_065816_alterlembur extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('tb_m_pegawai', ' gaji_lembur');
        $this->addColumn('tb_m_pegawai', 'gaji_lembur', $this->decimal(19, 2)->notNull()->defaultValue(0));
   
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190328_065816_alterlembur cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190328_065816_alterlembur cannot be reverted.\n";

        return false;
    }
    */
}
