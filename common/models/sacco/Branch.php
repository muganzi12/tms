<?php

namespace common\models\sacco;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property int $id
 * @property string $name
 * @property int $sacco_id
 * @property string $address
 * @property string $telephone
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'sacco_id', 'address', 'telephone', 'created_at', 'created_by'], 'required'],
            [['sacco_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name', 'address'], 'string', 'max' => 225],
            [['telephone'], 'string', 'max' => 13],
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
            'sacco_id' => 'Sacco ID',
            'address' => 'Address',
            'telephone' => 'Telephone',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
