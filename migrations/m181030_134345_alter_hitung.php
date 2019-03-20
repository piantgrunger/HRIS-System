<?php

use yii\db\Migration;

/**
 * Class m181030_134345_alter_hitung
 */
class m181030_134345_alter_hitung extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_mt_hitung_tunjangan', 'status_proses', $this->string(50));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181030_134345_alter_hitung cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181030_134345_alter_hitung cannot be reverted.\n";

        return false;
    }
    */
}
