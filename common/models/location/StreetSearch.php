<?php

namespace common\models\location;

use common\models\location\Street;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * StreetSearch represents the model behind the search form of `common\models\location\Street`.
 */
class StreetSearch extends Street
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'municipality', 'division', 'parish', 'village', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name'], 'safe'],
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
        $query = Street::find();

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
            'municipality' => $this->municipality,
            'division' => $this->division,
            'parish' => $this->parish,
            'village' => $this->village,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}