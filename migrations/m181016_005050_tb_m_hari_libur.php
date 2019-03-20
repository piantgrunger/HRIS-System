<?php

use yii\db\Migration;

/**
 * Class m181016_005050_tb_m_hari_libur
 */
class m181016_005050_tb_m_hari_libur extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_m_hari_libur', [
            'id_hari_libur' => $this->primaryKey(),
            'nama_hari_libur' => $this->string(50),
            'tanggal_libur' => $this->date()->unique(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181016_005050_tb_m_hari_libur cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181016_005050_tb_m_hari_libur cannot be reverted.\n";

        return false;
    }
    */
}
