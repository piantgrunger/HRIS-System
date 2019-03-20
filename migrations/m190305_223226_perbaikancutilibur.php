<?php

use yii\db\Migration;

/**
 * Class m190305_223226_perbaikancutilibur
 */
class m190305_223226_perbaikancutilibur extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("DROP PROCEDURE IF EXISTS generate_absen");
        $this->execute("CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_absen`(
	IN `tgl_awal` DATE,
	IN `tgl_akhir` DATE,
	IN `id_satuan_kerja` INT




)
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
COMMENT ''
BEGIN


          insert into tb_mt_absen(tgl_absen,id_pegawai,masuk_kerja,pulang_kerja,id_jenis_absen)
           select t.tanggal,m.id_pegawai,'00:00','00:00',ja.id_jenis_absen  from tp_tanggal t
           left join tb_m_pegawai m on m.id_satuan_kerja=id_satuan_kerja
           left join tb_mt_absen a on a.id_pegawai =m.id_pegawai and a.tgl_absen=t.tanggal

           left join tb_m_hari_libur h on h.tanggal_libur=t.tanggal
            left join tb_d_shift ds on ds.id_shift=m.id_shift and WEEKDAY(t.tanggal)   = ds.hari
           left join tb_m_jenis_absen ja on ja.nama_jenis_absen = case when (coalesce(ds.jam_masuk,'00:00:00')='00:00:00' and coalesce(jam_pulang,'00:00:00')='00:00:00')
           or h.id_hari_libur is not null then 'Libur' else 'Tanpa Keterangan' end

           where tanggal >=tgl_awal and tanggal <= tgl_akhir
           and a.id_absen is null
            order by m.nama,t.tanggal
            ;

             update
           tb_mt_absen m
          inner join tb_m_pegawai p on m.id_pegawai = p.id_pegawai
          inner join tb_m_jenis_absen ja on ja.id_jenis_absen =m.id_jenis_absen and ja.nama_jenis_absen='Tanpa Keterangan'
          left join tb_m_hari_libur h on h.tanggal_libur=m.tgl_absen
            left join tb_d_shift ds on ds.id_shift=p.id_shift and WEEKDAY(m.tgl_absen)   = ds.hari
           left join tb_m_jenis_absen ja1 on ja1.nama_jenis_absen = case when (coalesce(ds.jam_masuk,'00:00:00')='00:00:00' and coalesce(jam_pulang,'00:00:00')='00:00:00')
           or h.id_hari_libur is not null then 'Libur' else 'Tanpa Keterangan' end

          set m.id_jenis_absen=ja1.id_jenis_absen

		    where tgl_absen between tgl_awal and tgl_akhir
         and p.id_satuan_kerja=id_satuan_kerja;


             update
           tb_mt_absen m
          inner join tb_m_pegawai p on m.id_pegawai = p.id_pegawai
          inner join tb_m_jenis_absen ja on ja.id_jenis_absen =m.id_jenis_absen and ja.nama_jenis_absen<>'Libur'
          left join tb_m_hari_libur h on h.tanggal_libur=m.tgl_absen
            left join tb_d_shift ds on ds.id_shift=p.id_shift and WEEKDAY(m.tgl_absen)   = ds.hari
           left join tb_m_jenis_absen ja1 on ja1.nama_jenis_absen = case when (coalesce(ds.jam_masuk,'00:00:00')='00:00:00' and coalesce(jam_pulang,'00:00:00')='00:00:00')
           or h.id_hari_libur is not null then 'Libur' else 'Tanpa Keterangan' end

          set m.id_jenis_absen=ja1.id_jenis_absen

		    where tgl_absen between tgl_awal and tgl_akhir
		    and  ((coalesce(ds.jam_masuk,'00:00:00')='00:00:00' and coalesce(jam_pulang,'00:00:00')='00:00:00')
           or h.id_hari_libur is not null)
         and p.id_satuan_kerja=id_satuan_kerja;


                     update
           tb_mt_absen m
          inner join tb_m_pegawai p on m.id_pegawai = p.id_pegawai
          inner join tb_m_jenis_absen ja on ja.id_jenis_absen =m.id_jenis_absen and ja.status_hadir='Hadir'
          set
          terlambat_kerja =  case when m.masuk_kerja is not null then coalesce(m.terlambat_kerja,0)
          else 4 end
			 ,pulang_awal = case when m.pulang_kerja is not null then coalesce(m.pulang_awal,0) else 4 end

          where tgl_absen between tgl_awal and tgl_akhir
         and p.id_satuan_kerja=id_satuan_kerja;



        END");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190305_223226_perbaikancutilibur cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190305_223226_perbaikancutilibur cannot be reverted.\n";

        return false;
    }
    */
}
