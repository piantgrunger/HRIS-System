<?php

use yii\db\Migration;

/**
 * Class m181225_025551_lastprocess
 */
class m181225_025551_lastprocess extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_satuan_kerja', 'tanggal_absen_terakhir', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181225_025551_lastprocess cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181225_025551_lastprocess cannot be reverted.\n";

        return false;
    }
    */
}
