<?php

use yii\db\Migration;

/**
 * Class m190125_221728_alter_skp
 */
class m190125_221728_alter_skp extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_dt_skp', 'satuan_kuantitas', $this->string());
        $this->addColumn('tb_mt_skp', 'status_skp', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tb_dt_skp', 'satuan_qty');
        $this->dropColumn('tb_mt_skp', 'status_skp');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190125_221728_alter_skp cannot be reverted.\n";

        return false;
    }
    */
}
