<?php

use yii\db\Migration;

/**
 * Class m181025_141815_tb_mt_hitung_tunjangan
 */
class m181025_141815_tb_mt_hitung_tunjangan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_mt_hitung_tunjangan', [
            'id_hitung_tunjangan' => $this->primaryKey(),
            'tgl_awal' => $this->date()->notNull(),
            'tgl_akhir' => $this->date()->notNull(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tb_mt_hitung_tunjangan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181025_141815_tb_mt_hitung_tunjangan cannot be reverted.\n";

        return false;
    }
    */
}
