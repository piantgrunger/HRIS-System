<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "tb_m_jadwal_kerja".
 *
 * @property int $id_jadwal
 * @property int $id_satuan_kerja
 * @property string $tanggal_awal
 * @property string $tanggal_akhir
 * @property string $keterangan
 *
 * @property TbDJadwalKerja[] $tbDJadwalKerjas
 * @property TbMSatuanKerja $satuanKerja
 */
class JadwalKerja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_m_jadwal_kerja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_satuan_kerja', 'tanggal_awal', 'tanggal_akhir'], 'required'],
            [['id_satuan_kerja'], 'integer'],
            [['tanggal_awal', 'tanggal_akhir','id_unit_kerja'], 'safe'],
            [['keterangan'], 'string'],
            [['id_satuan_kerja'], 'exist', 'skipOnError' => true, 'targetClass' => SatuanKerja::className(), 'targetAttribute' => ['id_satuan_kerja' => 'id_satuan_kerja']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_jadwal' => 'Id Jadwal',
            'id_satuan_kerja' => 'Id Satuan Kerja',
            'tanggal_awal' => 'Tanggal Awal',
            'tanggal_akhir' => 'Tanggal Akhir',
            'keterangan' => 'Keterangan',
        ];
    }
    public function behaviors()
    {
        return [


            "tanggal_akhirBeforeSave" => [
                "class" => TimestampBehavior::className(),
                "attributes" => [
                    ActiveRecord::EVENT_BEFORE_INSERT => "tanggal_akhir",
                    ActiveRecord::EVENT_BEFORE_UPDATE => "tanggal_akhir",
                ],

                "value" => function () {
                    return implode("-", array_reverse(explode("-", $this->tanggal_akhir)));
                }



            ],






            "tanggal_awalBeforeSave" => [
                "class" => TimestampBehavior::className(),
                "attributes" => [
                    ActiveRecord::EVENT_BEFORE_INSERT => "tanggal_awal",
                    ActiveRecord::EVENT_BEFORE_UPDATE => "tanggal_awal",
                ],

                "value" => function () {
                    return implode("-", array_reverse(explode("-", $this->tanggal_awal)));
                }



            ],




        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailJadwalKerja()
    {
        return $this->hasMany(DetJadwalKerja::className(), ['id_jadwal' => 'id_jadwal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getUnitKerja()
    {
        return $this->hasOne(UnitKerja::className(), ['id_unit_kerja' => 'id_unit_kerja']);
    }

    public function getSatuanKerja()
    {
        return $this->hasOne(SatuanKerja::className(), ['id_satuan_kerja' => 'id_satuan_kerja']);
    }

    public function getNama_unit_kerja()
    {
        return is_null($this->unitKerja) ? '' : $this->unitKerja->nama_unit_kerja;
    }

}
