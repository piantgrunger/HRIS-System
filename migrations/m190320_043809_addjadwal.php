<?php

use yii\db\Migration;

/**
 * Class m190320_043809_addjadwal
 */
class m190320_043809_addjadwal extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->addColumn('tb_m_jadwal_kerja','id_unit_kerja',$this->integer() );
         $this->addForeignKey('fk_jadwal_unit_kerja', 'tb_m_jadwal_kerja', 'id_unit_kerja', 'tb_m_unit_kerja', 'id_unit_kerja');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190320_043809_addjadwal cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190320_043809_addjadwal cannot be reverted.\n";

        return false;
    }
    */
}
