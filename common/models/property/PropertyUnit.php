<?php

namespace common\models\property;

use common\models\property\Property;
use common\models\property\PropertyType;
use Yii;

/**
 * This is the model class for table "property_unit".
 *
 * @property int $id
 * @property string $name
 * @property string $unit_number
 * @property int $property
 * @property float $rate Rate per Unit
 * @property int $status
 * @property int $unit_type
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class PropertyUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'property_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'unit_number', 'property', 'rate', 'status', 'unit_type', 'created_at', 'created_by'], 'required'],
            [['property', 'status', 'unit_type', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['rate'], 'number'],
            [['name'], 'string', 'max' => 100],
            [['unit_number'], 'string', 'max' => 11],
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
            'unit_number' => 'Unit Number',
            'property' => 'Property',
            'rate' => 'Rate',
            'status' => 'Status',
            'unit_type' => 'Unit Type',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getPropertyName()
    {

        return $this->hasOne(Property::class, ['id' => 'property']);
    }

    public function getUnitType()
    {

        return $this->hasOne(PropertyType::class, ['id' => 'unit_type']);
    }
}
