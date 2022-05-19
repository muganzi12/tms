<?php

namespace common\models\loan;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\loan\Score;

/**
 * ScoreSearch represents the model behind the search form of `common\models\loan\Score`.
 */
class ScoreSearch extends Score
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'rate_item_id','loan_id','guadge_score_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['mark'], 'number'],
            [['reason'], 'safe'],
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
        $query = Score::find();

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
            'id' => $this->id,
            'client_id' => $this->client_id,
             'loan_id' => $this->loan_id,
            'guadge_score_id' => $this->guadge_score_id,
            'rate_item_id' => $this->rate_item_id,
            'mark' => $this->mark,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'reason', $this->reason]);

        return $dataProvider;
    }
}
