<?php

namespace common\models\report;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\report\AgingReport;

/**
 * AgingReportSearch represents the model behind the search form of `common\models\report\AgingReport`.
 */
class AgingReportSearch extends AgingReport
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entry_reference', 'debit_account', 'credit_account', 'entry_reference_id', 'schedule_id', 'created_at', 'created_by', 'entry_period', 'updated_at', 'updated_by', 'ledger_status', 'payment_ref', 'sub_legder'], 'integer'],
            [['description', 'due_date', 'next_date', 'entry_type', 'member_account', 'stage'], 'safe'],
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
        $query = AgingReport::find();

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
            'entry_reference' => $this->entry_reference,
            'amount' => $this->amount,
            'debit_account' => $this->debit_account,
            'credit_account' => $this->credit_account,
            'due_date' => $this->due_date,
            'next_date' => $this->next_date,
            'entry_reference_id' => $this->entry_reference_id,
            'schedule_id' => $this->schedule_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'entry_period' => $this->entry_period,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'ledger_status' => $this->ledger_status,
            'payment_ref' => $this->payment_ref,
            'sub_legder' => $this->sub_legder,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'entry_type', $this->entry_type])
            ->andFilterWhere(['like', 'member_account', $this->member_account])
            ->andFilterWhere(['like', 'stage', $this->stage]);

        return $dataProvider;
    }
}
