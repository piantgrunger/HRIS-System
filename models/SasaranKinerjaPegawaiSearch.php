<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SasaranKinerjaPegawai;

/**
 * SasaranKinerjaPegawaiSearch represents the model behind the search form of `app\models\SasaranKinerjaPegawai`.
 */
class SasaranKinerjaPegawaiSearch extends SasaranKinerjaPegawai
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_skp', 'id_pegawai', 'id_penilai', 'kuantitas', 'waktu', 'tahun'], 'integer'],
            [['uraian_tugas', 'satuan_kuantitas', 'satuan_waktu'], 'safe'],
            [['angka_kredit', 'biaya'], 'number'],
            [['tahun'],'default' ,'value' =>date("Y")]
        ];
    }

    /**
     * @inheritdoc
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
    public function search($params, $jenis = 0)
    {
        $query = SasaranKinerjaPegawai::find();

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
        $query->andFilterWhere([
            'id_skp' => $this->id_skp,
            'id_pegawai' => $this->id_pegawai,
            'id_penilai' => $this->id_penilai,
            'angka_kredit' => $this->angka_kredit,
            'kuantitas' => $this->kuantitas,
            'waktu' => $this->waktu,
            'biaya' => $this->biaya,
            'tahun' => $this->tahun,
        ]);

        $query->andFilterWhere(['like', 'uraian_tugas', $this->uraian_tugas])
            ->andFilterWhere(['like', 'satuan_kuantitas', $this->satuan_kuantitas])
            ->andFilterWhere(['like', 'satuan_waktu', $this->satuan_waktu]);
        if ($jenis == 0) {
            $query->andWhere(['id_pegawai' => Yii::$app->user->identity->id_pegawai]);
        } else {
            $query->andWhere(['id_penilai' => Yii::$app->user->identity->id_pegawai]);
        }


        return $dataProvider;
    }
}
