<?php

namespace common\models\client;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\client\Investor;

/**
 * InvestorSearch represents the model behind the search form of `common\models\client\Investor`.
 */
class InvestorSearch extends Investor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'identification_type', 'created_at', 'status', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['firstname', 'lastname', 'othername', 'identfication_number', 'telephone', 'physical_address', 'alt_telephone', 'email'], 'safe'],
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
        $query = Investor::find();

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
            'identification_type' => $this->identification_type,
            'created_at' => $this->created_at,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'othername', $this->othername])
            ->andFilterWhere(['like', 'identfication_number', $this->identfication_number])
            ->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'alt_telephone', $this->alt_telephone])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
