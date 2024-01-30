<?php

namespace common\models\collection;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\collection\Payment;

/**
 * PaymentSearch represents the model behind the search form of `common\models\collection\Payment`.
 */
class PaymentSearch extends Payment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'property', 'property_unit', 'payment_channel', 'payment_mode', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['payment_date', 'mobile_number'], 'safe'],
            [['amount'], 'number'],
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
        $query = Payment::find();

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
            'property_unit' => $this->property_unit,
            'amount' => $this->amount,
            'payment_channel' => $this->payment_channel,
            'payment_mode' => $this->payment_mode,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'payment_date', $this->payment_date])
            ->andFilterWhere(['like', 'mobile_number', $this->mobile_number]);

        return $dataProvider;
    }
}
