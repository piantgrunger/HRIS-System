<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_m_jabatan_fungsional".
 *
 * @property int    $id_jabatan_fungsional
 * @property string $kode_jabatan_fungsional
 * @property string $nama_jabatan_fungsional
 * @property string $ruang_awal
 * @property string $ruang_akhir
 */
class JabatanFungsional extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_m_jabatan_fungsional';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_jabatan_fungsional','status_jabatan','id_satuan_kerja','id_unit_kerja'], 'required'],

            [['nama_jabatan_fungsional'], 'string', 'max' => 100],
            [['ruang_awal', 'ruang_akhir'], 'string', 'max' => 4],
            [['nilai_jabatan', 'ikkd', 'tpp_dinamis', 'tpp_statis', 'tambahan_tunjangan_kinerja'], 'number'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_jabatan_fungsional' => Yii::t('app', 'Id Jabatan'),

            'nama_jabatan_fungsional' => Yii::t('app', 'Nama Jabatan'),
            'ruang_awal' => Yii::t('app', 'Ruang Awal'),
            'ruang_akhir' => Yii::t('app', 'Ruang Akhir'),
        ];
    }

    public function getUnit_kerja()
    {
        return $this->hasOne(UnitKerja::className(), ['id_unit_kerja' => 'id_unit_kerja']);
    }

    public function getNama_unit_kerja()
    {
        return is_null($this->unit_kerja) ? '' : $this->unit_kerja->nama_unit_kerja;
    }

    public function getSatuan_kerja()
    {
        return $this->hasOne(SatuanKerja::className(), ['id_satuan_kerja' => 'id_satuan_kerja']);
    }

    public function getEselon()
    {
        return $this->hasOne(Eselon::className(), ['id_eselon' => 'id_eselon']);
    }
    public function getNama_satuan_kerja()
    {
        return is_null($this->satuan_kerja) ? '' : $this->satuan_kerja->nama_satuan_kerja;
    }

    public function getNama_eselon()
    {
        return is_null($this->eselon) ? '' : $this->eselon->nama_eselon;
    }
}
