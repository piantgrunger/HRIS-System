<?php

use yii\db\Migration;

/**
 * Class m190127_114730_realisasi.
 */
class m190127_114730_realisasi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_mt_realisasi', [
            'id_realisasi' => $this->primaryKey(),
            'id_skp' => $this->integer()->notNull(),
            'id_d_skp' => $this->integer()->notNull(),
            'kuantitas' => $this->decimal(19, 2)->notNull(),
            'file_pendukung' => $this->string(100),
        ]);
        $this->addForeignKey('FK_tb_dt_realisasi1', 'tb_mt_realisasi', 'id_skp', 'tb_mt_skp', 'id_skp', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('FK_tb_dt_realisasi2', 'tb_mt_realisasi', 'id_d_skp', 'tb_dt_skp', 'id_d_skp', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190127_114730_realisasi cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190127_114730_realisasi cannot be reverted.\n";

        return false;
    }
    */
}
