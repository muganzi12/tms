<?php

namespace common\models\client;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\client\Account;

/**
 * ChartOfAccountsSearch represents the model behind the search form of `common\models\client\ChartOfAccounts`.
 */
class ChartOfAccountsSearch extends ChartOfAccounts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_id','gl_code','account_type', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['account_name','description','category'], 'safe'],
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
        $query = ChartOfAccounts::find();

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
            'gl_code' => $this->gl_code,
            'parent_id' => $this->parent_id,
            'account_type' => $this->account_type,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'account_name', $this->account_name])
                ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
