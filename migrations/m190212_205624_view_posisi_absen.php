<?php

use yii\db\Migration;

/**
 * Class m190212_205624_view_posisi_absen
 */
class m190212_205624_view_posisi_absen extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE OR REPLACE VIEW vw_posisi_absen
as
select id_satuan_kerja,DATE_FORMAT(a.tgl_absen,'%m-%Y') as periode ,max(a.tgl_absen) as tgl_absen_terakhir from tb_mt_absen a
inner join tb_m_pegawai p on p.id_pegawai=a.id_pegawai
where tgl_absen <=NOW()
group by id_satuan_kerja,DATE_FORMAT(a.tgl_absen,'%m-%Y')
order by id_satuan_kerja, DATE_FORMAT(a.tgl_absen,'%Y-%m')");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190212_205624_view_posisi_absen cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190212_205624_view_posisi_absen cannot be reverted.\n";

        return false;
    }
    */
}
