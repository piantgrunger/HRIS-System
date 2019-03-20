<?php

use yii\db\Migration;

/**
 * Class m190105_002648_vw_rekap_absen
 */
class m190105_002648_vw_rekap_absen extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE OR REPLACE VIEW vw_rekap_absen as

select id_pegawai,month(tgl_absen) as bulan,year(tgl_absen) as tahun,sum(a.terlambat_kerja+a.pulang_awal) as terlambat,sum(case when ja.nama_jenis_absen = 'Tanpa Keterangan' then 1 else 0 end ) as tanpa_keterangan,
sum(case when ja.nama_jenis_absen = 'Ijin' then 1 else 0 end ) as ijin,
sum(case when ja.nama_jenis_absen = 'Cuti' then 1 else 0 end ) as cuti,
sum(case when ja.nama_jenis_absen = 'Libur' then 1 else 0 end ) as libur


from tb_mt_absen a
inner join tb_m_jenis_absen ja on ja.id_jenis_absen = a.id_jenis_absen
group by id_pegawai,month(tgl_absen),year(tgl_absen)
");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190105_002648_vw_rekap_absen cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190105_002648_vw_rekap_absen cannot be reverted.\n";

        return false;
    }
    */
}
