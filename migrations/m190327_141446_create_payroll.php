<?php

use yii\db\Migration;

/**
 * Class m190327_141446_create_payroll
 */
class m190327_141446_create_payroll extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_pegawai', 'gaji_pokok', $this->decimal(19, 2)->notNull()->defaultValue(0));
        $this->addColumn('tb_m_pegawai', ' gaji_lembur', $this->decimal(19, 2)->notNull()->defaultValue(0));
        $this->createTable('tb_d_payroll_tunjangan', [
            'id_payroll' =>$this->primaryKey(),
            'id_pegawai' => $this->integer()->notNull(),
            'id_tunjangan' => $this->integer()->notNull(),
            'jumlah' => $this->decimal(19, 2),


        ]);
        $this->addForeignKey('fk_payroll_tjg', 'tb_d_payroll_tunjangan', 'id_pegawai', 'tb_m_pegawai', 'id_pegawai', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_payroll_tjg2', 'tb_d_payroll_tunjangan', 'id_tunjangan', 'tb_m_tunjangan', 'id_tunjangan', 'RESTRICT', 'CASCADE');



        $this->createTable('tb_d_payroll_Potongan', [
            'id_payroll' =>$this->primaryKey(),
            'id_pegawai' => $this->integer()->notNull(),
            'id_potongan' => $this->integer()->notNull(),
            'jumlah' => $this->decimal(19, 2),


        ]);
        $this->addForeignKey('fk_payroll_ptg', 'tb_d_payroll_potongan', 'id_pegawai', 'tb_m_pegawai', 'id_pegawai', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_payroll_ptg2', 'tb_d_payroll_potongan', 'id_potongan', 'tb_m_potongan', 'id_potongan', 'RESTRICT ', 'CASCADE');
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190327_141446_create_payroll cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190327_141446_create_payroll cannot be reverted.\n";

        return false;
    }
    */
}
