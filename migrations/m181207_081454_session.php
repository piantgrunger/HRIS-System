<?php

use yii\db\Migration;

/**
 * Class m181207_081454_session.
 */
class m181207_081454_session extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
         CREATE TABLE session (
            id CHAR(40) NOT NULL PRIMARY KEY,
            expire INTEGER,
            data BLOB
        )
         ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181207_081454_session cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181207_081454_session cannot be reverted.\n";

        return false;
    }
    */
}
