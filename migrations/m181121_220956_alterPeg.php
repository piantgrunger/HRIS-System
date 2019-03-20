<?php

use yii\db\Migration;

/**
 * Class m181121_220956_alterPeg
 */
class m181121_220956_alterPeg extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_pegawai', 'foto', $this->string(200));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181121_220956_alterPeg cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181121_220956_alterPeg cannot be reverted.\n";

        return false;
    }
    */
}
