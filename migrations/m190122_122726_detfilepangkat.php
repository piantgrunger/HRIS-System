<?php

use yii\db\Migration;

/**
 * Class m190122_122726_detfilepangkat
 */
class m190122_122726_detfilepangkat extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("tb_d_pegawai_file", [

            'id_d_pangkat' => $this->primaryKey(),
            'jenis' =>$this->string(50),
            'uraian1' => $this->string(50),
            'uraian2' => $this->string(50),

            'id_pegawai' => $this->integer(),
            'tanggal1' => $this->date(),

            'tanggal2' => $this->date(),

            'id_jabatan' => $this->integer(),
            'id_pangkat' => $this->integer(),
            'file' => $this->string(255),


        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("tb_d_pegawai_file");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190122_122726_detfilepangkat cannot be reverted.\n";

        return false;
    }
    */
}
