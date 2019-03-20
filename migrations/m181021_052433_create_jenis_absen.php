<?php

use yii\db\Migration;

/**
 * Class m181021_052433_create_jenis_absen
 */
class m181021_052433_create_jenis_absen extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_m_jenis_absen', [
            'id_jenis_absen' =>$this->primaryKey(),
            'nama_jenis_absen' => $this->string(50),
            'status_hadir' =>"enum('Hadir','Tidak Hadir')"

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181021_052433_create_jenis_absen cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181021_052433_create_jenis_absen cannot be reverted.\n";

        return false;
    }
    */
}
