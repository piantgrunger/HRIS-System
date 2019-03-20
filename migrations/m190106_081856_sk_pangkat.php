<?php

use yii\db\Migration;

/**
 * Class m190106_081856_sk_pangkat
 */
class m190106_081856_sk_pangkat extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("tb_m_pegawai", 'file_sk_pangkat', $this->string(10000));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190106_081856_sk_pangkat cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190106_081856_sk_pangkat cannot be reverted.\n";

        return false;
    }
    */
}
