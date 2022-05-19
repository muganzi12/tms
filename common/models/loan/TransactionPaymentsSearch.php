<?php

namespace common\models\loan;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\loan\TransactionPayments;

/**
 * TransactionPaymentsSearch represents the model behind the search form of `common\models\loan\TransactionPayments`.
 */
class TransactionPaymentsSearch extends TransactionPayments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'loan_id', 'created_at', 'created_by', 'credit_account', 'debit_account'], 'integer'],
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
        $query = TransactionPayments::find();

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
            'loan_id' => $this->loan_id,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'credit_account' => $this->credit_account,
            'debit_account' => $this->debit_account,
        ]);

        return $dataProvider;
    }
}
