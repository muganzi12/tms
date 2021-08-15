<?php

namespace common\models\client;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\client\Loan;

/**
 * LoanSearch represents the model behind the search form of `common\models\client\Loan`.
 */
class LoanSearch extends Loan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id', 'loan_type', 'status', 'loan_period', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['reference_number', 'application_date', 'disbursment_date', 'interest_frequency', 'installment_frequency', 'installment_payment_start_date', 'installment_payment_last_date', 'interest_payment_start_date', 'interest_payment_last_date'], 'safe'],
            [['amount_applied_for', 'amount_approved', 'interest_rate', 'payment_installment_amount'], 'number'],
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
        $query = Loan::find();

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
            'loan_type' => $this->loan_type,
            'amount_applied_for' => $this->amount_applied_for,
            'amount_approved' => $this->amount_approved,
            'application_date' => $this->application_date,
            'disbursment_date' => $this->disbursment_date,
            'status' => $this->status,
            'interest_rate' => $this->interest_rate,
            'payment_installment_amount' => $this->payment_installment_amount,
            'installment_payment_start_date' => $this->installment_payment_start_date,
            'installment_payment_last_date' => $this->installment_payment_last_date,
            'interest_payment_start_date' => $this->interest_payment_start_date,
            'interest_payment_last_date' => $this->interest_payment_last_date,
            'loan_period' => $this->loan_period,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'reference_number', $this->reference_number])
            ->andFilterWhere(['like', 'interest_frequency', $this->interest_frequency])
            ->andFilterWhere(['like', 'installment_frequency', $this->installment_frequency]);

        return $dataProvider;
    }
}
