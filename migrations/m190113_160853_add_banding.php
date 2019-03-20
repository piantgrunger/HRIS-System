<?php

use yii\db\Migration;

/**
 * Class m190113_160853_add_banding
 */
class m190113_160853_add_banding extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("tb_dt_hitung_tunjangan", "total_banding", $this->decimal(19, 2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190113_160853_add_banding cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190113_160853_add_banding cannot be reverted.\n";

        return false;
    }
    */
}
