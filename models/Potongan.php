<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_m_potongan".
 *
 * @property int $id_potongan
 * @property string $kode_potongan
 * @property string $nama_potongan
 * @property string $jenis_potongan
 * @property string $jumlah
 * @property string $keterangan
 */
class Potongan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_m_potongan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_potongan', 'nama_potongan', 'jenis_potongan', 'jumlah'], 'required'],
            [['jumlah'], 'number'],
            [['keterangan'], 'string'],
            [['kode_potongan', 'jenis_potongan'], 'string', 'max' => 50],
            [['nama_potongan'], 'string', 'max' => 100],
            [['kode_potongan'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_potongan' => 'Id Potongan',
            'kode_potongan' => 'Kode Potongan',
            'nama_potongan' => 'Nama Potongan',
            'jenis_potongan' => 'Jenis Potongan',
            'jumlah' => 'Jumlah',
            'keterangan' => 'Keterangan',
        ];
    }
}
