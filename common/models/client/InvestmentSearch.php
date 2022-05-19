<?php

namespace common\models\client;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\client\Investment;

/**
 * InvestmentSearch represents the model behind the search form of `common\models\client\Investment`.
 */
class InvestmentSearch extends Investment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'investor_id','status','created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['amount_to_invest', 'investment_duration','reference_number', 'interest_rate'], 'number'],
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
        $query = Investment::find();

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
            'reference_number' => $this->reference_number,
            'investor_id' => $this->investor_id,
            'amount_to_invest' => $this->amount_to_invest,
            'investment_duration' => $this->investment_duration,
            'interest_rate' => $this->interest_rate,
            'created_at' => $this->created_at,
             'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
