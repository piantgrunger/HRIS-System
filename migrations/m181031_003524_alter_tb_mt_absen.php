<?php

use yii\db\Migration;

/**
 * Class m181031_003524_alter_tb_mt_absen
 */
class m181031_003524_alter_tb_mt_absen extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_mt_absen', 'ptg_tidak_absen_plg', $this->decimal(18, 4));
        $this->alterColumn('tb_mt_absen', 'terlambat_kerja', $this->decimal(18, 4));
        $this->alterColumn('tb_mt_absen', 'pulang_awal', $this->decimal(18, 4));
        $this->addColumn('tb_mt_absen', 'total_ptg', $this->decimal(18, 4));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181031_003524_alter_tb_mt_absen cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181031_003524_alter_tb_mt_absen cannot be reverted.\n";

        return false;
    }
    */
}
