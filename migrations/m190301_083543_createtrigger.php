<?php

use yii\db\Migration;

/**
 * Class m190301_083543_createtrigger
 */
class m190301_083543_createtrigger extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE  TRIGGER `tb_mt_ijin_after_delete` AFTER DELETE ON `tb_mt_ijin` FOR EACH ROW BEGIN
    delete from tb_mt_absen where tgl_absen = old.tgl_absen and id_pegawai = old.id_pegawai
    and masuk_kerja = '00:00' and pulang_kerja = '00:00';

END");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190301_083543_createtrigger cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190301_083543_createtrigger cannot be reverted.\n";

        return false;
    }
    */
}
