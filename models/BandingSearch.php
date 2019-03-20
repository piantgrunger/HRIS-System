<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BandingSearch represents the model behind the search form of `app\models\Banding`.
 */
class BandingSearch extends Banding
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_banding', 'id_pegawai', 'id_atasan', 'id_absen'], 'integer'],
            [['tgl_banding', 'alasan', 'file', 'status_banding'], 'safe'],
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
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $mode = 0)
    {
        $query = Banding::find();

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
            'id_banding' => $this->id_banding,
            'tgl_banding' => $this->tgl_banding,
            'id_pegawai' => $this->id_pegawai,
            'id_atasan' => $this->id_atasan,
            'id_absen' => $this->id_absen,
        ]);

        $query->andFilterWhere(['like', 'alasan', $this->alasan])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'status_banding', $this->status_banding]);

        if (!is_null(Yii::$app->user->identity->id_pegawai)) {
            if ($mode == 0) {
                $query->andWhere(['id_pegawai' => Yii::$app->user->identity->id_pegawai]);
            } else {
                $query->andWhere(['id_atasan' => Yii::$app->user->identity->id_pegawai]);
            }
        }

        return $dataProvider;
    }
}
