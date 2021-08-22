<?php

namespace common\models\client;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\client\LoanManagerRemarks;

/**
 * LoanManagerRemarksSearch represents the model behind the search form of `common\models\client\LoanManagerRemarks`.
 */
class LoanManagerRemarksSearch extends LoanManagerRemarks {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'loan_id', 'client_id', 'remarks_status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['category', 'remarks'], 'safe'],
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
        $query = LoanManagerRemarks::find();

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
            'client_id' => $this->client_id,
            'created_at' => $this->created_at,
            'remarks_status' => $this->remarks_status,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'category', $this->category])
                ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }

}
