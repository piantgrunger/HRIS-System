<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_m_tunjangan".
 *
 * @property int $id_tunjangan
 * @property string $kode_tunjangan
 * @property string $nama_tunjangan
 * @property string $jenis_tunjangan
 * @property string $jumlah
 * @property string $keterangan
 */
class Tunjangan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_m_tunjangan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_tunjangan', 'nama_tunjangan', 'jenis_tunjangan', 'jumlah'], 'required'],
            [['jumlah'], 'number'],
            [['keterangan'], 'string'],
            [['kode_tunjangan', 'jenis_tunjangan'], 'string', 'max' => 50],
            [['nama_tunjangan'], 'string', 'max' => 100],
            [['kode_tunjangan'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tunjangan' => Yii::t('app', 'Id Tunjangan'),
            'kode_tunjangan' => Yii::t('app', 'Kode Tunjangan'),
            'nama_tunjangan' => Yii::t('app', 'Nama Tunjangan'),
            'jenis_tunjangan' => Yii::t('app', 'Jenis Tunjangan'),
            'jumlah' => Yii::t('app', 'Jumlah'),
            'keterangan' => Yii::t('app', 'Keterangan'),
        ];
    }
}
