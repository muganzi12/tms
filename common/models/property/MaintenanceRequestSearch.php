<?php

namespace common\models\property;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\property\MaintenanceRequest;

/**
 * MaintenanceRequestSearch represents the model behind the search form of `common\models\property\MaintenanceRequest`.
 */
class MaintenanceRequestSearch extends MaintenanceRequest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'property_id', 'unit', 'maintainer', 'issue_type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['request_date', 'attachment', 'notes'], 'safe'],
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
        $query = MaintenanceRequest::find();

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
            'property_id' => $this->property_id,
            'unit' => $this->unit,
            'maintainer' => $this->maintainer,
            'issue_type' => $this->issue_type,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'request_date', $this->request_date])
            ->andFilterWhere(['like', 'attachment', $this->attachment])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
