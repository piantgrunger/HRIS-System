<?php

use yii\db\Migration;

/**
 * Class m181122_221724_alterhit
 */
class m181122_221724_alterhit extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_mt_absen', 'total_jam_potong', $this->decimal(19, 2));
        $this->addColumn('tb_mt_absen', 'id_hitung_tunjangan', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181122_221724_alterhit cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181122_221724_alterhit cannot be reverted.\n";

        return false;
    }
    */
}
