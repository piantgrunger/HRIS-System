<?php

use yii\db\Migration;

/**
 * Class m190307_131628_hitung
 */
class m190307_131628_hitung extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("DROP PROCEDURE IF EXISTS hitung_tunjangan");
        $this->execute("CREATE DEFINER=`root`@`localhost` PROCEDURE `hitung_tunjangan`(
	IN `tgl_awal` DATE,
	IN `tgl_akhir` DATE,
	IN `id_satuan_kerja` INT,
	IN `id` INT













)
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
COMMENT ''
BEGIN

          update
           tb_mt_absen m
          inner join tb_m_pegawai p on m.id_pegawai = p.id_pegawai
          inner join tb_m_jenis_absen ja on ja.id_jenis_absen =m.id_jenis_absen and ja.status_hadir='Hadir'
          set
          total_jam_potong =  case when m.masuk_kerja is not null then coalesce(m.terlambat_kerja,0)
          else 4 end + case when m.pulang_kerja is not null then coalesce(m.pulang_awal,0) else 4 end

          where tgl_absen between tgl_awal and tgl_akhir
         and p.id_satuan_kerja=id_satuan_kerja;


         create temporary table tp_banding (

          select mb.id_pegawai,sum(a1. total_jam_potong  ) as total_jam_potong
			 from tb_mt_banding mb
			 left outer join tb_mt_absen a1 on a1.id_absen=mb.id_absen
          where mb.status_banding = 'Diterima'
          and mb.tgl_banding between tgl_awal and tgl_akhir
          group by mb.id_pegawai


			);

          update
           tb_mt_absen m
          inner join tb_m_pegawai p on m.id_pegawai = p.id_pegawai
          inner join tb_m_jenis_absen ja on ja.id_jenis_absen =m.id_jenis_absen and ja.status_hadir='Tidak Hadir'
          set id_hitung_tunjangan = id ,
          total_jam_potong =  case when ja.nama_jenis_absen='Tanpa Keterangan' then 8 else 0 end
          where tgl_absen between tgl_awal and tgl_akhir
          and p.id_satuan_kerja=id_satuan_kerja;


           insert into tb_dt_hitung_tunjangan(id_hitung_tunjangan,id_pegawai,jumlah_absen,total_jam_potong,tunjangan_tpp,capaian_kinerja,tambahan_tpp,total_tunjangan,total_banding)
            select id, p.id_pegawai,sum(case when ja.nama_jenis_absen<>'Libur' then 1 else 0 end),sum(coalesce(a.total_jam_potong,0)),coalesce(j1.tunjangan_tpp/2,case when coalesce(j1.tambahan_tpp,0) =0 then j.ikkd*j.nilai_jabatan else null end,case when coalesce(j1.tambahan_tpp,0) =0 then j.tpp_statis else null end,g.ikkd*g.nilai_jabatan),100,j1.tambahan_tpp,
        case when  ((coalesce(j1.tunjangan_tpp/2,case when coalesce(j1.tambahan_tpp,0) =0 then j.ikkd*j.nilai_jabatan else null end,case when coalesce(j1.tambahan_tpp,0) =0 then j.tpp_statis else null end,g.ikkd*g.nilai_jabatan)) +( coalesce(j1.tunjangan_tpp/2, case when coalesce(j1.tambahan_tpp,0) =0 then j.ikkd*j.nilai_jabatan else null end,case when coalesce(j1.tambahan_tpp,0) =0 then j.tpp_statis else null end,g.ikkd*g.nilai_jabatan) *100/100 ))
          -(sum(coalesce(a.total_jam_potong,0))*0.635/100*(coalesce(j1.tunjangan_tpp/2,case when coalesce(j1.tambahan_tpp,0) =0 then j.ikkd*j.nilai_jabatan else null end,case when coalesce(j1.tambahan_tpp,0) =0 then j.tpp_statis else null end,g.ikkd*g.nilai_jabatan))+coalesce(j1.tunjangan_tpp/2,j.tambahan_tunjangan_kinerja,0))
          < 0 then 0 else
          ((coalesce(j1.tunjangan_tpp/2,case when coalesce(j1.tambahan_tpp,0) =0 then j.ikkd*j.nilai_jabatan else null end,case when coalesce(j1.tambahan_tpp,0) =0 then j.tpp_statis else null end,g.ikkd*g.nilai_jabatan)) +(coalesce(j1.tunjangan_tpp/2,case when coalesce(j1.tambahan_tpp,0) =0 then j.ikkd*j.nilai_jabatan else null end,case when coalesce(j1.tambahan_tpp,0) =0 then j.tpp_statis else null end,g.ikkd*g.nilai_jabatan) *100/100 ))
          -(sum(coalesce(a.total_jam_potong,0))*0.635/100*(coalesce(j1.tunjangan_tpp/2,case when coalesce(j1.tambahan_tpp,0) =0 then j.ikkd*j.nilai_jabatan else null end,case when coalesce(j1.tambahan_tpp,0) =0 then j.tpp_statis else null end,g.ikkd*g.nilai_jabatan)))
           end+coalesce(j1.tambahan_tpp,0)
           +((coalesce(a1.total_jam_potong,0)) *0.635/100*(coalesce(j1.tunjangan_tpp/2,case when coalesce(j1.tambahan_tpp,0) =0 then j.ikkd*j.nilai_jabatan else null end,case when coalesce(j1.tambahan_tpp,0) =0 then j.tpp_statis else null end,g.ikkd*g.nilai_jabatan)))
			  ,((coalesce(a1.total_jam_potong,0)) *0.635/100*(coalesce(j1.tunjangan_tpp/2,case when coalesce(j1.tambahan_tpp,0) =0 then j.ikkd*j.nilai_jabatan else null end,case when coalesce(j1.tambahan_tpp,0) =0 then j.tpp_statis else null end,g.ikkd*g.nilai_jabatan)))

          from tb_m_pegawai p
          left outer join tb_mt_absen a on a.id_pegawai=p.id_pegawai and a.tgl_absen between tgl_awal and tgl_akhir
           left outer join tb_m_jenis_absen ja on ja.id_jenis_absen =a.id_jenis_absen

          left outer join tb_m_golongan g on g.id_golongan=p.id_golongan
          left outer join tb_m_jabatan_fungsional j on j.id_jabatan_fungsional=p.id_jabatan_fungsional
          left outer join tb_m_jabatan_tambahan j1 on j1.id_jabatan_tambahan=p.id_jabatan_tambahan
          left outer join tp_banding a1 on a1.id_pegawai=p.id_pegawai

          where p.id_satuan_kerja = id_satuan_kerja
          and p.jenis_pegawai = 'Pegawai Negeri Sipil'
          group by p.id_pegawai,coalesce(j1.tunjangan_tpp/2,case when coalesce(j1.tambahan_tpp,0) =0 then j.ikkd*j.nilai_jabatan else null end,case when coalesce(j1.tambahan_tpp,0) =0 then j.tpp_statis else null end,g.ikkd*g.nilai_jabatan);



    drop table tp_banding;
        END");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190307_131628_hitung cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190307_131628_hitung cannot be reverted.\n";

        return false;
    }
    */
}
