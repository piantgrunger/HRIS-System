<?php

use yii\db\Migration;

/**
 * Class m181213_230158_fixitung
 */
class m181213_230158_fixitung extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('DROP PROCEDURE IF EXISTS `hitung_tunjangan`');
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
          set id_hitung_tunjangan = id ,
          total_jam_potong =  case when m.masuk_kerja is not null then coalesce(m.terlambat_kerja,0)
          else 4 end + case when m.pulang_kerja is not null then coalesce(m.pulang_awal,0) else 4 end

          where tgl_absen between tgl_awal and tgl_akhir
         and p.id_satuan_kerja=id_satuan_kerja;

          update
           tb_mt_absen m
          inner join tb_m_pegawai p on m.id_pegawai = p.id_pegawai
          inner join tb_m_jenis_absen ja on ja.id_jenis_absen =m.id_jenis_absen and ja.status_hadir='Tidak Hadir'
          set id_hitung_tunjangan = id ,
          total_jam_potong =  case when ja.nama_jenis_absen='Alpha' then 8 else 0 end
          where tgl_absen between tgl_awal and tgl_akhir
          and p.id_satuan_kerja=id_satuan_kerja;


           insert into tb_dt_hitung_tunjangan(id_hitung_tunjangan,id_pegawai,jumlah_absen,total_jam_potong,tunjangan_tpp,capaian_kinerja,tambahan_tpp,total_tunjangan)
            select id, p.id_pegawai,count(a.id_absen),sum(coalesce(a.total_jam_potong,0)),coalesce(j.ikkd*j.nilai_jabatan,j.tpp_statis,g.ikkd*g.nilai_jabatan),100,j.tambahan_tunjangan_kinerja,
        case when  ((coalesce(j.ikkd*j.nilai_jabatan,j.tpp_statis,g.ikkd*g.nilai_jabatan)) +(coalesce(j.ikkd*j.nilai_jabatan,j.tpp_statis,g.ikkd*g.nilai_jabatan) *100/100 ))
          -(sum(coalesce(a.total_jam_potong,0))*0.635/100*(coalesce(j.ikkd*j.nilai_jabatan,j.tpp_statis,g.ikkd*g.nilai_jabatan))+coalesce(j.tambahan_tunjangan_kinerja,0))
          < 0 then 0 else
          ((coalesce(j.ikkd*j.nilai_jabatan,j.tpp_statis,g.ikkd*g.nilai_jabatan)) +(coalesce(j.ikkd*j.nilai_jabatan,j.tpp_statis,g.ikkd*g.nilai_jabatan) *100/100 ))
          -(sum(coalesce(a.total_jam_potong,0))*0.635/100*(coalesce(j.ikkd*j.nilai_jabatan,j.tpp_statis,g.ikkd*g.nilai_jabatan)))
          end+coalesce(j.tambahan_tunjangan_kinerja,0)
          from tb_m_pegawai p
          left outer join tb_mt_absen a on a.id_pegawai=p.id_pegawai and a.id_hitung_tunjangan=id
          left outer join tb_m_golongan g on g.id_golongan=p.id_golongan
          left outer join tb_m_jabatan_fungsional j on j.id_jabatan_fungsional=p.id_jabatan_fungsional
          where p.id_satuan_kerja = id_satuan_kerja
          and p.jenis_pegawai = 'Pegawai Negeri Sipil'
          group by p.id_pegawai;



        END");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181213_230158_fixitung cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181213_230158_fixitung cannot be reverted.\n";

        return false;
    }
    */
}
