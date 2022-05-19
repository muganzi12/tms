<?php

namespace common\models\loan;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\loan\LedgerPayment;

/**
 * LedgerPaymentSearch represents the model behind the search form of `common\models\loan\LedgerPayment`.
 */
class LedgerPaymentSearch extends LedgerPayment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'reference_no','loan_id','schedule_id', 'payment_method', 'created_at', 'created_by', 'updated_by', 'updated_at'], 'integer'],
            [['paid_by', 'payment_date', 'description', 'proof_attachment'], 'safe'],
            [['amount_paid'], 'number'],
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
        $query = LedgerPayment::find();

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
            'reference_no' => $this->reference_no,
            'payment_method' => $this->payment_method,
            'amount_paid' => $this->amount_paid,
            'loan_id' => $this->loan_id,
            'schedule_id' => $this->schedule_id,
            'payment_date' => $this->payment_date,
           // 'debit_account' => $this->debit_account,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'paid_by', $this->paid_by])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'proof_attachment', $this->proof_attachment]);

        return $dataProvider;
    }
}
