<?php

use yii\db\Migration;

/**
 * Class m190317_024917_altertb_dt_hitung_tunjangan
 */
class m190317_024917_altertb_dt_hitung_tunjangan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("tb_dt_hitung_tunjangan", "keterangan", $this->string(100));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190317_024917_altertb_dt_hitung_tunjangan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190317_024917_altertb_dt_hitung_tunjangan cannot be reverted.\n";

        return false;
    }
    */
}
