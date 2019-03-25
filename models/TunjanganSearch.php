<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tunjangan;

/**
 * TunjanganSearch represents the model behind the search form of `app\models\Tunjangan`.
 */
class TunjanganSearch extends Tunjangan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tunjangan'], 'integer'],
            [['kode_tunjangan', 'nama_tunjangan', 'jenis_tunjangan', 'keterangan'], 'safe'],
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
        $query = Tunjangan::find();

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
            'id_tunjangan' => $this->id_tunjangan,
            'jumlah' => $this->jumlah,
        ]);

        $query->andFilterWhere(['like', 'kode_tunjangan', $this->kode_tunjangan])
            ->andFilterWhere(['like', 'nama_tunjangan', $this->nama_tunjangan])
            ->andFilterWhere(['like', 'jenis_tunjangan', $this->jenis_tunjangan])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
