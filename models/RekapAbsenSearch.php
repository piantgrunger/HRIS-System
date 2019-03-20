<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RekapAbsen;

/**
 * RekapAbsenSearch represents the model behind the search form of `app\models\RekapAbsen`.
 */
class RekapAbsenSearch extends RekapAbsen
{
    /**
     * {@inheritdoc}
     */
    public $id_satuan_kerja;

    public function rules()
    {
        return [
            [['bulan', 'tahun', 'id_pegawai'], 'integer'],
            [['id_satuan_kerja', 'bulan', 'tahun'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RekapAbsen::find()
            ->innerJoin('tb_m_pegawai', 'tb_m_pegawai.id_pegawai=vw_rekap_absen.id_pegawai')
            ->leftJoin('tb_m_jabatan_fungsional', 'tb_m_jabatan_fungsional.id_jabatan_fungsional=tb_m_pegawai.id_jabatan_fungsional')
            ->leftJoin('tb_m_golongan', 'tb_m_golongan.id_golongan=tb_m_pegawai.id_golongan')
            ->leftJoin('tb_m_eselon', 'tb_m_eselon.id_eselon=tb_m_jabatan_fungsional.id_eselon')

            ->leftJoin('tb_m_satuan_kerja', 'tb_m_satuan_kerja.id_satuan_kerja=tb_m_pegawai.id_satuan_kerja');
        ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andWhere([
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
            'tb_m_pegawai.id_satuan_kerja' => $this->id_satuan_kerja,
        ]);

        return $dataProvider;
    }
}
