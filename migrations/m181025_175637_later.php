<?php

use yii\db\Migration;

/**
 * Class m181025_175637_later
 */
class m181025_175637_later extends Migration
{
    /**
     * {@inheritdoc}
     */
    public $tableName = '{{%queue}}';

    public function safeUp()
    {
        $this->addColumn($this->tableName, 'timeout', $this->integer()->defaultValue(0)->notNull()->after('created_at'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181025_175637_later cannot be reverted.\n";

        return false;
    }
    */
}
