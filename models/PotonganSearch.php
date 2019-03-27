<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Potongan;

/**
 * PotonganSearch represents the model behind the search form of `app\models\Potongan`.
 */
class PotonganSearch extends Potongan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_potongan'], 'integer'],
            [['kode_potongan', 'nama_potongan', 'jenis_potongan', 'keterangan'], 'safe'],
            [['jumlah'], 'number'],
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
    public function search($params)
    {
        $query = Potongan::find();

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
            'id_potongan' => $this->id_potongan,
            'jumlah' => $this->jumlah,
        ]);

        $query->andFilterWhere(['like', 'kode_potongan', $this->kode_potongan])
            ->andFilterWhere(['like', 'nama_potongan', $this->nama_potongan])
            ->andFilterWhere(['like', 'jenis_potongan', $this->jenis_potongan])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
