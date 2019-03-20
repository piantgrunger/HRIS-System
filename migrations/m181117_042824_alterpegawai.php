<?php

use yii\db\Migration;

/**
 * Class m181117_042824_alterpegawai.
 */
class m181117_042824_alterpegawai extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_pegawai', 'id_level_jabatan', $this->integer());
        $this->addColumn('tb_m_pegawai', 'kode_checklog', $this->string(100));
        $this->addForeignKey('fk_pegawai_level_jabatan',
        'tb_m_pegawai',
        'id_level_jabatan',
        'tb_m_level_jabatan',
        'id_level_jabatan'
    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181117_042824_alterpegawai cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181117_042824_alterpegawai cannot be reverted.\n";

        return false;
    }
    */
}
