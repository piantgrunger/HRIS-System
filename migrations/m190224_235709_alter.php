<?php

use yii\db\Migration;

/**
 * Class m190224_235709_alter
 */
class m190224_235709_alter extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('tb_mt_absen', 'terlambat_kerja', $this->integer());
        $this->alterColumn('tb_mt_absen', 'pulang_awal', $this->integer());
        $this->alterColumn('tb_dt_hitung_tunjangan', 'total_jam_potong', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190224_235709_alter cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190224_235709_alter cannot be reverted.\n";

        return false;
    }
    */
}
