<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_d_payroll_potongan".
 *
 * @property int $id_payroll
 * @property int $id_pegawai
 * @property int $id_potongan
 * @property string $jumlah
 *
 * @property TbMPegawai $pegawai
 * @property TbMPotongan $potongan
 */
class DetPayrollPotongan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_d_payroll_potongan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pegawai', 'id_potongan'], 'required'],
            [['id_pegawai', 'id_potongan'], 'integer'],
            [['jumlah'], 'number'],
            [['id_pegawai'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['id_pegawai' => 'id_pegawai']],
            [['id_potongan'], 'exist', 'skipOnError' => true, 'targetClass' => Potongan::className(), 'targetAttribute' => ['id_potongan' => 'id_potongan']],
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
            'id_potongan' => 'Id Potongan',
            'jumlah' => 'Jumlah',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['id_pegawai' => 'id_pegawai']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPotongan()
    {
        return $this->hasOne(Potongan::className(), ['id_potongan' => 'id_potongan']);
    }
}
