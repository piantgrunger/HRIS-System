<?php

use yii\db\Migration;

/**
 * Class m190101_052026_tmt
 */
class m190101_052026_tmt extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_pegawai', 'tmt', $this->date());
        $this->execute("update tb_m_pegawai p
set tmt = (select  r.tmt from tb_m_riwayat_jabatan r where id_pegawai=p.id_pegawai order by tmt desc limit 1)
");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190101_052026_tmt cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190101_052026_tmt cannot be reverted.\n";

        return false;
    }
    */
}
