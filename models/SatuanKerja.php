<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_m_satuan_kerja".
 *
 * @property int $id_satuan_kerja
 * @property string $nama_satuan_kerja
 */
class SatuanKerja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_m_satuan_kerja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_satuan_kerja' ,'checklog_key'], 'required'],
            [['nama_satuan_kerja'], 'string', 'max' => 100],
            [['tanggal_absen_terakhir'],'string']
        ];
    }

    public function getStatus_validasi_bulan_ini()
    {
        return !(is_null(Validasi::find()->where(["id_satuan_kerja"=>$this->id_satuan_kerja,"periode"=>date("mm-YYYY") ])->one()));
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_satuan_kerja' => Yii::t('app', 'Id Satuan Kerja'),
            'nama_satuan_kerja' => Yii::t('app', 'Nama Satuan Kerja'),
        ];
    }
}
