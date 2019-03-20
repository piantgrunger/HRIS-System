<?php

use yii\db\Migration;

/**
 * Class m181204_113203_user
 */
class m181204_113203_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(" insert into auth_assignment select 'PNS',id,1111 from user where id >1");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181204_113203_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181204_113203_user cannot be reverted.\n";

        return false;
    }
    */
}
