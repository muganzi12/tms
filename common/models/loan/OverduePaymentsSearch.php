<?php

namespace common\models\loan;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\loan\OverduePayments;

/**
 * LedgerPaymentSearch represents the model behind the search form of `common\models\loan\LedgerPayment`.
 */
class OverduePaymentsSearch extends OverduePayments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account', 'created_at', 'updated_at','ledger_status','entry_period','entry_reference','entry_reference_id'], 'integer'],
            [['member_Account', 'description'], 'safe'],
            [['due_date'], 'number'],
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
        $query = OverduePayments::find();

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
            'account' => $this->account,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'ledger_status' => $this->ledger_status,
            'entry_period' => $this->entry_period,
            'entry_reference' => $this->entry_reference,
        ]);

        $query->andFilterWhere(['like', 'member_Account', $this->member_Account])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'due_date', $this->due_date]);

        return $dataProvider;
    }
}
