<?php

namespace common\models\loan;

use Yii;

/**
 * This is the model class for table "borrow_requirements".
 *
 * @property int $id
 * @property string $name
 * @property string $category
 * @property int $created_at
 */
class BorrowRequirements extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'borrow_requirements';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category', 'created_at'], 'required'],
            [['created_at'], 'integer'],
            [['name'], 'string', 'max' => 225],
            [['category'], 'string', 'max' => 20],
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
            'category' => 'Category',
            'created_at' => 'Created At',
        ];
    }
}
