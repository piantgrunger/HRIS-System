<?php

use yii\db\Migration;

/**
 * Class m190106_135243_sk_jabatan
 */
class m190106_135243_sk_jabatan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("tb_m_pegawai", 'file_sk_jabatan', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190106_135243_sk_jabatan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190106_135243_sk_jabatan cannot be reverted.\n";

        return false;
    }
    */
}
