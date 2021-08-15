<?php

namespace common\models\client;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\client\LoanProduct;

/**
 * LoanProductSearch represents the model behind the search form of `common\models\client\LoanProduct`.
 */
class LoanProductSearch extends LoanProduct {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'account_to_credit', 'product_code', 'account_to_debit', 'maximum_repayment_period', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name', 'description', 'product_code'], 'safe'],
            [['interest_rate', 'processing_loan_fees', 'minimum_amount', 'maximum_amount', 'penalty'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = LoanProduct::find();

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
            'interest_rate' => $this->interest_rate,
            'account_to_credit' => $this->account_to_credit,
            'account_to_debit' => $this->account_to_debit,
            'processing_loan_fees' => $this->processing_loan_fees,
            'minimum_amount' => $this->minimum_amount,
            'maximum_amount' => $this->maximum_amount,
            'maximum_repayment_period' => $this->maximum_repayment_period,
            'status' => $this->status,
            'penalty' => $this->penalty,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'product_code', $this->product_code])
                ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

}
