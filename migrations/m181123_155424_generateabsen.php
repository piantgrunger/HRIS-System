<?php

use yii\db\Migration;

/**
 * Class m181123_155424_generateabsen
 */
class m181123_155424_generateabsen extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("DROP PROCEDURE IF EXISTS `generate_absen`");
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
   left join tb_m_jenis_absen ja on ja.nama_jenis_absen = case when (ds.jam_masuk='00:00' and jam_pulang='00:00')
   or h.id_hari_libur is not null then 'Libur' else 'Alpha' end

   where tanggal >=tgl_awal and tanggal <= tgl_akhir
   and a.id_absen is null
	order by m.nama,t.tanggal
	;

END");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181123_155424_generateabsen cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181123_155424_generateabsen cannot be reverted.\n";

        return false;
    }
    */
}
