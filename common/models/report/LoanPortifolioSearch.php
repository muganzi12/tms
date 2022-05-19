<?php

namespace common\models\report;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\report\LoanPortifolio;

/**
 * AgingReportSearch represents the model behind the search form of `common\models\report\AgingReport`.
 */
class LoanPortifolioSearch extends LoanPortifolio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loan_id', 'created_by', 'created_at'], 'required'],
            [['loan_id', 'created_by', 'created_at'], 'integer'],
            [['principal_amount', 'principal_paid', 'interest_amount', 'interest_paid'], 'number'],
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
        $query = LoanPortifolio::find();

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
            'loan_id' => $this->loan_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'principal_amount', $this->principal_amount])
            ->andFilterWhere(['like', 'principal_paid', $this->principal_paid])
            ->andFilterWhere(['like', 'interest_amount', $this->interest_amount])
            ->andFilterWhere(['like', 'interest_paid', $this->interest_paid]);

        return $dataProvider;
    }
}
