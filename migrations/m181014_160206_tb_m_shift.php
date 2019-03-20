<?php

use yii\db\Migration;

/**
 * Class m181014_160206_tb_m_shift
 */
class m181014_160206_tb_m_shift extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'tb_m_shift',
            [
                'id_shift' => $this->primaryKey(),
                'nama_shift' => $this->string(100)->notNull(),
            ]
            );
        $this->createTable(
            'tb_d_shift',
            [
                'id_shift' => $this->integer()->notNull(),

                'id_d_shift' => $this->primaryKey(),
                'hari' => $this->integer()->notNull(),
                'jam_masuk' => $this->time()->notNull(),
                'jam_pulang' => $this->time()->notNull(),

            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(
            'tb_m_shift'
        );
        $this->dropTable(
            'tb_d_shift'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181014_160206_tb_m_shift cannot be reverted.\n";

        return false;
    }
    */
}
