<?php

use yii\db\Migration;

/**
 * Class m181205_040734_trigger_eselon.
 */
class m181205_040734_trigger_eselon extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('CREATE TRIGGER `tb_m_eselon_after_update` AFTER UPDATE ON `tb_m_eselon` FOR EACH ROW UPDATE tb_m_jabatan_fungsional set ikkd = new.ikkd,nilai_jabatan=new.nilai_jabatan,tpp_dinamis=new.tpp_dinamis, tpp_statis=new.tpp_statis where id_eselon=new.id_eselon;');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181205_040734_trigger_eselon cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181205_040734_trigger_eselon cannot be reverted.\n";

        return false;
    }
    */
}
