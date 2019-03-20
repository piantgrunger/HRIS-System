<?php

use yii\db\Migration;

/**
 * Class m181213_131752_create_admin_user
 */
class m181213_131752_create_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("update user u
inner join tb_m_pegawai m on u.id_pegawai=m.id_pegawai
inner join tb_m_jabatan_fungsional j on j.id_jabatan_fungsional=m.id_jabatan_fungsional and j.nama_jabatan_fungsional='KEPALA SUB BAGIAN UMUM DAN KEPEGAWAIAN'
set u.id_satuan_kerja=m.id_satuan_kerja;");

        $this->execute("insert into  auth_item (name,type)
values ('Admin SKPD',1)");

        $this->execute("insert into auth_assignment select distinct 'Admin SKPD',u.id,11111 from user u
inner join tb_m_pegawai m on u.id_pegawai=m.id_pegawai
inner join tb_m_jabatan_fungsional j on j.id_jabatan_fungsional=m.id_jabatan_fungsional and j.nama_jabatan_fungsional='KEPALA SUB BAGIAN UMUM DAN KEPEGAWAIAN'


");
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
        echo "m181213_131752_create_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
