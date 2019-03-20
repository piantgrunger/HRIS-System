<?php

use yii\db\Migration;

/**
 * Class m181225_074542_tb_m_jabatan_tambahan
 */
class m181225_074542_tb_m_jabatan_tambahan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("tb_m_jabatan_tambahan", [
            'id_jabatan_tambahan' =>$this->primaryKey(),
            'nama_jabatan' => $this->string(100),
            'tambahan_tpp' => $this->decimal(19, 2)
        ]);
        $this->addColumn("tb_m_pegawai", "id_jabatan_tambahan", $this->integer());
        $this->addForeignKey(
            "fk_pegawai_jabatan_tambahan",
        "tb_m_pegawai",
        "id_jabatan_tambahan",
            "tb_m_jabatan_tambahan",
            "id_jabatan_tambahan",
            "RESTRICT",
            "CASCADE"

        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181225_074542_tb_m_jabatan_tambahan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181225_074542_tb_m_jabatan_tambahan cannot be reverted.\n";

        return false;
    }
    */
}
