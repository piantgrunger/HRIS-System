<?php

use yii\db\Migration;

/**
 * Class m190325_070916_create_tb_m_tunjangan
 */
class m190325_070916_create_tb_m_tunjangan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_m_tunjangan',[
            'id_tunjangan' => $this->primaryKey(),
            'kode_tunjangan' => $this->string(50)->unique()->notNull(),
            'nama_tunjangan' => $this->string(100)->notNull(),
            'jenis_tunjangan' => $this->string(50)->notNull(),
            'jumlah' => $this->decimal(19,2)->notNull(),
            'keterangan' => $this->text()
            
            
            
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190325_070916_create_tb_m_tunjangan cannot be reverted.\n";

        return false;
    }
    */
}
