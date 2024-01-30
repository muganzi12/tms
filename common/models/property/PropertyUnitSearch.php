<?php

namespace common\models\property;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\property\PropertyUnit;

/**
 * PropertyUnitSearch represents the model behind the search form of `common\models\property\PropertyUnit`.
 */
class PropertyUnitSearch extends PropertyUnit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'property', 'floor', 'number_of_rooms', 'status', 'unit_type', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['unit_number'], 'safe'],
            [['rate'], 'number'],
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
        $query = PropertyUnit::find();

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
            'property' => $this->property,
            'floor' => $this->floor,
            'number_of_rooms' => $this->number_of_rooms,
            'rate' => $this->rate,
            'status' => $this->status,
            'unit_type' => $this->unit_type,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'unit_number', $this->unit_number]);

        return $dataProvider;
    }
}