<?php

use yii\db\Migration;

/**
 * Class m181117_094013_alter_pegawai
 */
class m181117_094013_alter_pegawai extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk_pegawai_level_jabatan', 'tb_m_pegawai');
        $this->dropColumn('tb_m_pegawai', 'id_level_jabatan');
        $this->addColumn('tb_m_pegawai', 'id_golongan', $this->integer());
        $this->addForeignKey(
            'fk_pegawai_golongan',
        'tb_m_pegawai',
        'id_golongan',
        'tb_m_golongan',
        'id_golongan'
    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181117_094013_alter_pegawai cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181117_094013_alter_pegawai cannot be reverted.\n";

        return false;
    }
    */
}
