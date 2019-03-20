<?php

use yii\db\Migration;

/**
 * Class m181205_033432_alter_eselon.
 */
class m181205_033432_alter_eselon extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_eselon', 'nilai_jabatan', $this->decimal(19, 2)->null());
        $this->addColumn('tb_m_eselon', 'ikkd', $this->decimal(19, 2)->null());
        $this->addColumn('tb_m_eselon', 'tpp_dinamis', $this->decimal(19, 2)->null());
        $this->addColumn('tb_m_eselon', 'tpp_statis', $this->decimal(19, 2)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181205_033432_alter_eselon cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181205_033432_alter_eselon cannot be reverted.\n";

        return false;
    }
    */
}
