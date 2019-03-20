<?php

use yii\db\Migration;

/**
 * Class m181127_103740_create_PNS.
 */
class m181127_103740_create_PNS extends Migration
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
        echo "m181127_103740_create_PNS cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181127_103740_create_PNS cannot be reverted.\n";

        return false;
    }
    */
}
