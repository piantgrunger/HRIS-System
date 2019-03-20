<?php

use yii\db\Migration;

/**
 * Class m190212_010425_create_tb_validasi
 */
class m190212_010425_create_tb_validasi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_mt_validasi', [
                'id_validasi' => $this->primaryKey(),
                'id_satuan_kerja' => $this->integer()->notNull(),
                'periode' => $this->string()->notNull(),
                'tanggal_validasi' => $this->date()->notNull(),
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190212_010425_create_tb_validasi cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190212_010425_create_tb_validasi cannot be reverted.\n";

        return false;
    }
    */
}
