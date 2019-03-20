<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_d_jadwal_kerja".
 *
 * @property int $id_d_jadwal
 * @property int $id_jadwal
 * @property int $id_pegawai
 * @property string $tanggal
 * @property string $jam_masuk
 * @property string $jam_pulang
 *
 * @property TbMJadwalKerja $jadwal
 * @property TbMPegawai $pegawai
 */
class DetJadwalKerja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_d_jadwal_kerja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_jadwal', 'id_pegawai', 'tanggal', 'jam_masuk', 'jam_pulang'], 'required'],
            [['id_jadwal', 'id_pegawai'], 'integer'],
            [['tanggal', 'jam_masuk', 'jam_pulang'], 'safe'],
            [['id_jadwal'], 'exist', 'skipOnError' => true, 'targetClass' => JadwalKerja::className(), 'targetAttribute' => ['id_jadwal' => 'id_jadwal']],
            [['id_pegawai'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['id_pegawai' => 'id_pegawai']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_d_jadwal' => 'Id D Jadwal',
            'id_jadwal' => 'Id Jadwal',
            'id_pegawai' => 'Id Pegawai',
            'tanggal' => 'Tanggal',
            'jam_masuk' => 'Jam Masuk',
            'jam_pulang' => 'Jam Pulang',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwal()
    {
        return $this->hasOne(JadwalKerja::className(), ['id_jadwal' => 'id_jadwal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['id_pegawai' => 'id_pegawai']);
    }
}
