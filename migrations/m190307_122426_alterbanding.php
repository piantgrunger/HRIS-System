<?php

use yii\db\Migration;

/**
 * Class m190307_122426_alterbanding
 */
class m190307_122426_alterbanding extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("update tb_mt_banding set status_banding='Belum Diapprove' where status_banding is null ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190307_122426_alterbanding cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190307_122426_alterbanding cannot be reverted.\n";

        return false;
    }
    */
}
