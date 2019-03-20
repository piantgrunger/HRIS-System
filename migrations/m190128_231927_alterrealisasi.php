<?php

use yii\db\Migration;

/**
 * Class m190128_231927_alterrealisasi
 */
class m190128_231927_alterrealisasi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_mt_realisasi', 'status_realisasi', $this->string(20));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tb_mt_realisasi', 'status_realisasi');
        $this->dropColumn('tb_mt_realisasi', 'kualitas_realisasi');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190128_231927_alterrealisasi cannot be reverted.\n";

        return false;
    }
    */
}
