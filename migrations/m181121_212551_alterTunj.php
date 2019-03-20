<?php

use yii\db\Migration;

/**
 * Class m181121_212551_alterTunj
 */
class m181121_212551_alterTunj extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /*  'nilai_jabatan' => $this->decimal(19, 2)->notNull(),
            'ikkd' => $this->decimal(19, 2)->notNull(),
            'tpp_dinamis' => $this->decimal(19, 2)->notNull(),
            'tpp_statis' => $this->decimal(19, 2)->notNull(),
         */
        $this->addColumn('tb_m_jabatan_fungsional', 'nilai_jabatan', $this->decimal(19, 2)->null());
        $this->addColumn('tb_m_jabatan_fungsional', 'ikkd', $this->decimal(19, 2)->null());
        $this->addColumn('tb_m_jabatan_fungsional', 'tpp_dinamis', $this->decimal(19, 2)->null());
        $this->addColumn('tb_m_jabatan_fungsional', 'tpp_statis', $this->decimal(19, 2)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tb_m_jabatan_fungsional', 'nilai_jabatan');
        $this->dropColumn('tb_m_jabatan_fungsional', 'ikkd');
        $this->dropColumn('tb_m_jabatan_fungsional', 'tpp_dinamis');
        $this->dropColumn('tb_m_jabatan_fungsional', 'tpp_statis');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181121_212551_alterTunj cannot be reverted.\n";

        return false;
    }
    */
}
