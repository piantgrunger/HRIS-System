<?php

use yii\db\Migration;

/**
 * Class m190227_104651_alter_view_rekap
 */
class m190227_104651_alter_view_rekap extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("CREATE OR REPLACE VIEW vw_rekap_absen AS
        select `a`.`id_pegawai` AS `id_pegawai`,month(`a`.`tgl_absen`) AS `bulan`,
year(`a`.`tgl_absen`) AS `tahun`,sum((`a`.`terlambat_kerja` + `a`.`pulang_awal`)) AS `terlambat`,
sum((case when (`ja`.`nama_jenis_absen` = 'Tanpa Keterangan') then 1 else 0 end)) AS `tanpa_keterangan`,
sum((case when (`ja`.`nama_jenis_absen` = 'Ijin') then 1 else 0 end)) AS `ijin`,
sum((case when (`ja`.`nama_jenis_absen` = 'Cuti') then 1 else 0 end)) AS `cuti`,
sum((case when (`ja`.`nama_jenis_absen` = 'Libur') then 1 else 0 end)) AS `libur`,
sum((case when (`ja`.`nama_jenis_absen` = 'Sakit') then 1 else 0 end)) AS `sakit`,
sum((case when (`ja`.`nama_jenis_absen` = 'Dinas Luar') then 1 else 0 end)) AS `dinas_luar`,
sum((case when (`ja`.`nama_jenis_absen` = 'Ijin Terlambat') then 1 else 0 end)) AS `ijin_pagi`,
sum((case when (`ja`.`nama_jenis_absen` = 'Ijin Pulang Awal') then 1 else 0 end)) AS `ijin_sore`



 from (`tb_mt_absen` `a` join `tb_m_jenis_absen` `ja` on((`ja`.`id_jenis_absen` = `a`.`id_jenis_absen`)))
 group by `a`.`id_pegawai`,month(`a`.`tgl_absen`),year(`a`.`tgl_absen`)

        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190227_104651_alter_view_rekap cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190227_104651_alter_view_rekap cannot be reverted.\n";

        return false;
    }
    */
}
