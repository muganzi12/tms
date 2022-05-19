<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "office_held".
 *
 * @property int $id
 * @property string $name
 * @property int $created_at
 * @property int $created_by
 */
class OfficeHeld extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'office_held';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'created_by'], 'required'],
            [['created_at', 'created_by'], 'integer'],
            [['name'], 'string', 'max' => 1000],
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
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }
}
