<?php

namespace common\models\loan;

use Yii;

/**
 * This is the model class for table "rated_item".
 *
 * @property int $id
 * @property string $name
 * @property float $marks
 * @property int $created_at
 * @property int $created_by
 */
class RatedItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rated_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'marks', 'created_at', 'created_by'], 'required'],
            [['marks'], 'number'],
            [['created_at', 'created_by'], 'integer'],
            [['name','client_type'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'marks' => 'Marks',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }
    
       public static function transactionByTag($product='CS'){
        return RatedItem::find()
                ->where(['client_type'=>$product])
                ->all();
    }
}
