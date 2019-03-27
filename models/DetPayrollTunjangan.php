<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_d_payroll_tunjangan".
 *
 * @property int $id_payroll
 * @property int $id_pegawai
 * @property int $id_tunjangan
 * @property string $jumlah
 *
 * @property TbMPegawai $pegawai
 * @property TbMTunjangan $tunjangan
 */
class DetPayrollTunjangan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_d_payroll_tunjangan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pegawai', 'id_tunjangan'], 'required'],
            [['id_pegawai', 'id_tunjangan'], 'integer'],
            [['jumlah'], 'number'],
            [['id_pegawai'], 'exist', 'skipOnError' => true, 'targetClass' => TbMPegawai::className(), 'targetAttribute' => ['id_pegawai' => 'id_pegawai']],
            [['id_tunjangan'], 'exist', 'skipOnError' => true, 'targetClass' => TbMTunjangan::className(), 'targetAttribute' => ['id_tunjangan' => 'id_tunjangan']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_payroll' => 'Id Payroll',
            'id_pegawai' => 'Id Pegawai',
            'id_tunjangan' => 'Id Tunjangan',
            'jumlah' => 'Jumlah',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawai()
    {
        return $this->hasOne(TbMPegawai::className(), ['id_pegawai' => 'id_pegawai']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTunjangan()
    {
        return $this->hasOne(TbMTunjangan::className(), ['id_tunjangan' => 'id_tunjangan']);
    }
}
