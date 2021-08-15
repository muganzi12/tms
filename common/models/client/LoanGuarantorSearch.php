<?php

namespace common\models\client;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\client\LoanGuarantor;

/**
 * LoanGuarantorSearch represents the model behind the search form of `common\models\client\LoanGuarantor`.
 */
class LoanGuarantorSearch extends LoanGuarantor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'loan_id', 'identification_type', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['firstname', 'lastname', 'othername', 'identification_number', 'telephone_primary', 'telephone_alternative', 'employer_name', 'source_of_income', 'physical_address'], 'safe'],
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
        $query = LoanGuarantor::find();

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
            'identification_type' => $this->identification_type,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'othername', $this->othername])
            ->andFilterWhere(['like', 'identification_number', $this->identification_number])
            ->andFilterWhere(['like', 'telephone_primary', $this->telephone_primary])
            ->andFilterWhere(['like', 'telephone_alternative', $this->telephone_alternative])
            ->andFilterWhere(['like', 'employer_name', $this->employer_name])
            ->andFilterWhere(['like', 'source_of_income', $this->source_of_income])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address]);

        return $dataProvider;
    }
}
