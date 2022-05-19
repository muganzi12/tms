<?php

namespace common\models\loan;

use Yii;

/**
 * This is the model class for table "guadge".
 *
 * @property int $id
 * @property string $name
 * @property float $marks
 * @property int $created_at
 */
class Guadge extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guadge';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'marks', 'created_at'], 'required'],
            [['marks'], 'number'],
            [['created_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
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
        ];
    }
}
