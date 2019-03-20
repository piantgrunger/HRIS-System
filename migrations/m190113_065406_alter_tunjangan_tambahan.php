<?php

use yii\db\Migration;

/**
 * Class m190113_065406_alter_tunjangan_tambahan
 */
class m190113_065406_alter_tunjangan_tambahan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_jabatan_tambahan', 'tunjangan_tpp', $this->decimal(19, 2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190113_065406_alter_tunjangan_tambahan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190113_065406_alter_tunjangan_tambahan cannot be reverted.\n";

        return false;
    }
    */
}
