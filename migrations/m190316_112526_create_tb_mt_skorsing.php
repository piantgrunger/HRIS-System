<?php

use yii\db\Migration;

/**
 * Class m190316_112526_create_tb_mt_skorsing
 */
class m190316_112526_create_tb_mt_skorsing extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("tb_mt_skorsing", [
             "id_skorsing" => $this->primaryKey(),
             "id_pegawai" => $this->integer()->notNull(),
             'tanggal_awal' => $this->date()->notNull(),
            'tanggal_akhir' => $this->date()->notNull(),
            "keterangan" => $this->text()

         ]);

        $this->addForeignKey('fk_skorsing_pegawai', 'tb_mt_skorsing', 'id_pegawai', 'tb_m_pegawai', 'id_pegawai');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190316_112526_create_tb_mt_skorsing cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190316_112526_create_tb_mt_skorsing cannot be reverted.\n";

        return false;
    }
    */
}
