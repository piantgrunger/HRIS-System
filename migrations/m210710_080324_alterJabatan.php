<?php

use yii\db\Migration;

/**
 * Class m210710_080324_alterJabatan
 */
class m210710_080324_alterJabatan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('tb_m_jabatan_fungsional', 'ruang_akhir', $this->string()->null());


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210710_080324_alterJabatan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210710_080324_alterJabatan cannot be reverted.\n";

        return false;
    }
    */
}
