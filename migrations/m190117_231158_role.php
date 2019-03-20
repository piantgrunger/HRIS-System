<?php

use yii\db\Migration;

/**
 * Class m190117_231158_role
 */
class m190117_231158_role extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //   $this->execute("insert into roles (name,display_name,description,parent,dept,created_at,updated_at) values
        //    ('NON PNS','NON PNS','NON PNS',1,1,'2019-01-01','2019-01-01')
        //  ");
        $this->execute(" insert into auth_assignment select 'NON PNS',id,1111 from tb_m_pegawai p
        inner join user u on p.id_pegawai =u.id_pegawai
        where jenis_pegawai <>'Pegawai Negeri Sipil'  and coalesce(NIP,'') <> '' ");
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
        echo "m190117_231158_role cannot be reverted.\n";

        return false;
    }
    */
}
