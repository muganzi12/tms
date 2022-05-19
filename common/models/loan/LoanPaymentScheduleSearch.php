<?php

namespace common\models\loan;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\loan\LoanPaymentSchedule;

/**
 * LoanPaymentScheduleSearch represents the model behind the search form of `common\models\loan\LoanPaymentSchedule`.
 */
class LoanPaymentScheduleSearch extends LoanPaymentSchedule
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'loan_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['due_date'], 'safe'],
            [['principal_amount', 'interest_amount', 'principal_paid', 'interest_paid'], 'number'],
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
        $query = LoanPaymentSchedule::find();

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
            'due_date' => $this->due_date,
            'principal_amount' => $this->principal_amount,
            'interest_amount' => $this->interest_amount,
            'principal_paid' => $this->principal_paid,
            'interest_paid' => $this->interest_paid,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
