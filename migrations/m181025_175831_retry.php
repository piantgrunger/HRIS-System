<?php

use yii\db\Migration;

/**
 * Class m181025_175831_retry
 */
class m181025_175831_retry extends Migration
{
    /**
     * {@inheritdoc}
     */
    public $tableName = '{{%queue}}';

    public function safeUp()
    {
        $this->renameColumn($this->tableName, 'created_at', 'pushed_at');
        $this->addColumn($this->tableName, 'ttr', $this->integer()->notNull()->after('pushed_at'));
        $this->renameColumn($this->tableName, 'timeout', 'delay');
        $this->dropIndex('started_at', $this->tableName);
        $this->renameColumn($this->tableName, 'started_at', 'reserved_at');
        $this->createIndex('reserved_at', $this->tableName, 'reserved_at');
        $this->addColumn($this->tableName, 'attempt', $this->integer()->after('reserved_at'));
        $this->renameColumn($this->tableName, 'finished_at', 'done_at');
        //   $this->createIndex('channel', $this->tableName, 'channel');
        // $this->createIndex('reserved_at', $this->tableName, 'reserved_at');
        $this->addColumn($this->tableName, 'priority', $this->integer()->unsigned()->notNull()->defaultValue(1024)->after('delay'));
        $this->createIndex('priority', $this->tableName, 'priority');
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
        echo "m181025_175831_retry cannot be reverted.\n";

        return false;
    }
    */
}
