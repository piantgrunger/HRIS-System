<?php

use yii\db\Migration;

/**
 * Class m181205_041340_fkjabatan.
 */
class m181205_041340_fkjabatan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-jabatan-esselon',
        'tb_m_jabatan_fungsional',
        'id_eselon',
        'tb_m_eselon',
        'id_eselon',
        'RESTRICT',
        'CASCADE'
    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181205_041340_fkjabatan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181205_041340_fkjabatan cannot be reverted.\n";

        return false;
    }
    */
}
