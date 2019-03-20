<?php

use yii\db\Migration;

/**
 * Class m190213_235547_alter_pegawai
 */
class m190213_235547_alter_pegawai extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_pegawai', 'status', $this->string(20)->notNull()->defaultValue("Aktif"));
        $this->execute("update tb_m_pegawai set status = 'pensiun' where id_satuan_kerja is null ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190213_235547_alter_pegawai cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190213_235547_alter_pegawai cannot be reverted.\n";

        return false;
    }
    */
}
