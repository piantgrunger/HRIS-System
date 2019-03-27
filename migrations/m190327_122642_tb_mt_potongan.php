<?php

use yii\db\Migration;

/**
 * Class m190327_122642_tb_mt_potongan
 */
class m190327_122642_tb_mt_potongan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_m_potongan', [
             'id_potongan' => $this->primaryKey(),
            'kode_potongan' => $this->string(50)->unique()->notNull(),
            'nama_potongan' => $this->string(100)->notNull(),
            'jenis_potongan' => $this->string(50)->notNull(),
            'jumlah' => $this->decimal(19, 2)->notNull(),
            'keterangan' => $this->text()



        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190327_122642_tb_mt_potongan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190327_122642_tb_mt_potongan cannot be reverted.\n";

        return false;
    }
    */
}
