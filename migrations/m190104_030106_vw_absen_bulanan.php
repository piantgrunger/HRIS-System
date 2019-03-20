<?php

use yii\db\Migration;

/**
 * Class m190104_030106_vw_absen_bulanan.
 */
class m190104_030106_vw_absen_bulanan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE OR REPLACE VIEW vw_absen_bulanan as 
        select month(tgl_absen) as bulan,year(tgl_absen) as tahun,a.id_pegawai,
max(case when day(tgl_absen)=1 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 1_pagi,
max(case when day(tgl_absen)=1 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 1_siang,
max(case when day(tgl_absen)=2 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 2_pagi,
max(case when day(tgl_absen)=2 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 2_siang,
max(case when day(tgl_absen)=3 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 3_pagi,
max(case when day(tgl_absen)=3 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 3_siang,
max(case when day(tgl_absen)=4 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 4_pagi,
max(case when day(tgl_absen)=4 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 4_siang,
max(case when day(tgl_absen)=5 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 5_pagi,
max(case when day(tgl_absen)=5 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 5_siang,

max(case when day(tgl_absen)=6 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 6_pagi,
max(case when day(tgl_absen)=6 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 6_siang,
max(case when day(tgl_absen)=7 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 7_pagi,
max(case when day(tgl_absen)=7 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 7_siang,
max(case when day(tgl_absen)=8 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 8_pagi,
max(case when day(tgl_absen)=8 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 8_siang,
max(case when day(tgl_absen)=9 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 9_pagi,
max(case when day(tgl_absen)=9 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 9_siang,
max(case when day(tgl_absen)=10 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 10_pagi,
max(case when day(tgl_absen)=10 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 10_siang,


max(case when day(tgl_absen)=11 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 11_pagi,
max(case when day(tgl_absen)=11 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 11_siang,
max(case when day(tgl_absen)=12 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 12_pagi,
max(case when day(tgl_absen)=12 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 12_siang,
max(case when day(tgl_absen)=13 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 13_pagi,
max(case when day(tgl_absen)=13 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 13_siang,
max(case when day(tgl_absen)=14 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 14_pagi,
max(case when day(tgl_absen)=14 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 14_siang,
max(case when day(tgl_absen)=15 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 15_pagi,
max(case when day(tgl_absen)=15 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 15_siang,

max(case when day(tgl_absen)=16 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 16_pagi,
max(case when day(tgl_absen)=16 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 16_siang,
max(case when day(tgl_absen)=17 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 17_pagi,
max(case when day(tgl_absen)=17 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 17_siang,
max(case when day(tgl_absen)=18 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 18_pagi,
max(case when day(tgl_absen)=18 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 18_siang,
max(case when day(tgl_absen)=19 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 19_pagi,
max(case when day(tgl_absen)=19 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 19_siang,
max(case when day(tgl_absen)=20 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 20_pagi,
max(case when day(tgl_absen)=20 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 20_siang,


max(case when day(tgl_absen)=21 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 21_pagi,
max(case when day(tgl_absen)=21 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 21_siang,
max(case when day(tgl_absen)=22 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 22_pagi,
max(case when day(tgl_absen)=22 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 22_siang,
max(case when day(tgl_absen)=23 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 23_pagi,
max(case when day(tgl_absen)=23 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 23_siang,
max(case when day(tgl_absen)=24 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 24_pagi,
max(case when day(tgl_absen)=24 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 24_siang,
max(case when day(tgl_absen)=25 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 25_pagi,
max(case when day(tgl_absen)=25 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 25_siang,

max(case when day(tgl_absen)=26 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 26_pagi,
max(case when day(tgl_absen)=26 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 26_siang,
max(case when day(tgl_absen)=27 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 27_pagi,
max(case when day(tgl_absen)=27 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 27_siang,
max(case when day(tgl_absen)=28 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 28_pagi,
max(case when day(tgl_absen)=28 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 28_siang,
max(case when day(tgl_absen)=29 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 29_pagi,
max(case when day(tgl_absen)=29 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 29_siang,
max(case when day(tgl_absen)=30 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 30_pagi,
max(case when day(tgl_absen)=30 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 30_siang,
max(case when day(tgl_absen)=31 then (case when ja.status_hadir='Hadir' then   masuk_kerja else ja.nama_jenis_absen end) end) as 31_pagi,
max(case when day(tgl_absen)=31 then (case when ja.status_hadir='Hadir' then   pulang_kerja else ja.nama_jenis_absen end) end) as 31_siang





from tb_mt_absen a
inner join tb_m_jenis_absen ja on ja.id_jenis_absen=a.id_jenis_absen
group by month(tgl_absen),year(tgl_absen),a.id_pegawai 
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
        echo "m190104_030106_vw_absen_bulanan cannot be reverted.\n";

        return false;
    }
    */
}
