<?php

use yii\db\Migration;

/**
 * Class m181025_175412_queue
 */
class m181025_175412_queue extends Migration
{
    /**
     * {@inheritdoc}
     */
    public $tableName = '{{%queue}}';
    public $tableOptions;

    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'channel' => $this->string()->notNull(),
            'job' => $this->binary()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'started_at' => $this->integer(),
            'finished_at' => $this->integer(),
        ], $this->tableOptions);

        $this->createIndex('channel', $this->tableName, 'channel');
        $this->createIndex('started_at', $this->tableName, 'started_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
            $this->dropTable($this->tableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181025_175412_queue cannot be reverted.\n";

        return false;
    }
    */
}
