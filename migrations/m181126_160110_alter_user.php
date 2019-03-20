<?php

use yii\db\Migration;

/**
 * Class m181126_160110_alter_user
 */
class m181126_160110_alter_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("user", "id_pegawai", $this->integer());
        $this->addColumn("user", "id_satuan_kerja", $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181126_160110_alter_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181126_160110_alter_user cannot be reverted.\n";

        return false;
    }
    */
}
