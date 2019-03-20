<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
 * Class m181014_163154_tb_m_shift
 */
class m181014_163154_tb_m_shift extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-shift-detai-master',
            'tb_d_shift',
            'id_shift',
            'tb_m_shift',
            'id_shift',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181014_163154_tb_m_shift cannot be reverted.\n";

        return false;
    }
    */
}
