<?php

use yii\db\Migration;

/**
 * Class m190125_224244_alter_skp
 */
class m190125_224244_alter_skp extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn("tb_dt_skp", "kuantitas", $this->decimal(19, 2)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190125_224244_alter_skp cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190125_224244_alter_skp cannot be reverted.\n";

        return false;
    }
    */
}
