<?php

use yii\db\Migration;

/**
 * Class m190219_050307_altertable
 */
class m190219_050307_altertable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('idx-uq-absen', "tb_mt_absen", ["tgl_absen","id_pegawai"], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190219_050307_altertable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190219_050307_altertable cannot be reverted.\n";

        return false;
    }
    */
}
