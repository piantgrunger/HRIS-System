<?php

use yii\db\Migration;

/**
 * Class m190109_050125_ijin_absen.
 */
class m190109_050125_ijin_absen extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_mt_absen', 'alasan', $this->text());
        $this->addColumn('tb_mt_absen', 'file_pendukung', $this->string(100));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190109_050125_ijin_absen cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190109_050125_ijin_absen cannot be reverted.\n";

        return false;
    }
    */
}
