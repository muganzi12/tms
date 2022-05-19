<?php

namespace common\models\loan;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\loan\LedgerTransactionConfig;

/**
 * LedgerTransactionConfigSearch represents the model behind the search form of `common\models\loan\LedgerTransactionConfig`.
 */
class LedgerTransactionConfigSearch extends LedgerTransactionConfig
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'debit_account', 'credit_account', 'is_primary', 'parent_id','product_id', 'created_at', 'created_by', 'updated_by', 'updated_at'], 'integer'],
            [['transaction_name', 'amount_rule','description','tags'], 'safe'],
            [['amount'], 'number'],
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
        $query = LedgerTransactionConfig::find();

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
            'debit_account' => $this->debit_account,
            'credit_account' => $this->credit_account,
            'amount' => $this->amount,
            'is_primary' => $this->is_primary,
            'parent_id' => $this->parent_id,
            'product_id' => $this->product_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
        ->andFilterWhere(['like', 'transaction_name', $this->transaction_name])
                   ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'amount_rule', $this->amount_rule]);

        return $dataProvider;
    }
}
