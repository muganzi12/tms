<?php

namespace common\models\report;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\report\LoanInterest;

/**
 * LoanInterestSearch represents the model behind the search form of `common\models\report\LoanInterest`.
 */
class LedgerReportSearch extends LedgerReport
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member_account','ledger_status'], 'integer'],
            [['due_date','description'], 'safe'],
            [['member_account'], 'number'],
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
        $query = LedgerReport::find();

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

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'member_account', $this->member_account])
         ->andFilterWhere(['like', 'due_date', $this->due_date]);

        return $dataProvider;
    }
}
