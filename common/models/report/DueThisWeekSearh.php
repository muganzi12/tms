<?php

namespace common\models\report;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\report\DueThisWeek;


/**
 * DueThisWeekSearh represents the model behind the search form of `common\models\report\DueThisWeek`.
 */
class DueThisWeekSearh extends DueThisWeek
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entry_reference', 'debit_account', 'credit_account', 'entry_reference_id', 'created_at', 'created_by', 'entry_period', 'updated_at', 'updated_by', 'ledger_status', 'payment_ref'], 'integer'],
            [['description', 'due_date', 'entry_type', 'stage', 'member_account'], 'safe'],
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
        $query = DueThisWeek::find();

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
            'entry_reference_id' => $this->entry_reference_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'entry_period' => $this->entry_period,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'ledger_status' => $this->ledger_status,
            'payment_ref' => $this->payment_ref,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'entry_type', $this->entry_type])
            ->andFilterWhere(['like', 'stage', $this->stage])
            ->andFilterWhere(['like', 'member_account', $this->member_account]);

        return $dataProvider;
    }
}
