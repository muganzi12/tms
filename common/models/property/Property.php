<?php

namespace common\models\property;

use common\models\location\District;
use common\models\location\Division;
use common\models\location\Parish;
use common\models\location\Street;
use common\models\location\Village;
use common\models\property\PropertyType;
use Yii;

/**
 * This is the model class for table "property".
 *
 * @property int $id
 * @property string $name
 * @property int $type
 * @property string|null $description
 * @property int $municipality
 * @property int $division
 * @property int $parish
 * @property int $village
 * @property int $street
 * @property string $plot_number
 * @property int $house_number
 * @property string|null $attachment
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Property extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'property';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'municipality', 'division', 'parish', 'village', 'street', 'plot_number', 'house_number', 'status', 'created_at', 'created_by'], 'required'],
            [['type', 'municipality', 'division', 'parish', 'village', 'street', 'house_number', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['name', 'plot_number'], 'string', 'max' => 100],
            [['attachment'], 'string', 'max' => 255],
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
            'type' => 'Property Type',
            'description' => 'Description',
            'municipality' => 'Municipality',
            'division' => 'Division',
            'parish' => 'Parish',
            'village' => 'Village',
            'street' => 'Street',
            'plot_number' => 'Plot Number',
            'house_number' => 'House Number',
            'attachment' => 'Attachment',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    // Get list of Municipalities

    public function getMunicipalityName()
    {

        return $this->hasOne(District::class, ['id' => 'municipality']);
    }

    // Get list of Divisions

    public function getDivisionName()
    {

        return $this->hasOne(Division::class, ['id' => 'division']);
    }

    // Get list of Parishes

    public function getParishName()
    {

        return $this->hasOne(Parish::class, ['id' => 'parish']);
    }

    // Get list of Villages

    public function getVillageName()
    {

        return $this->hasOne(Village::class, ['id' => 'parish']);
    }

    // Get list of Villages

    public function getStreetName()
    {

        return $this->hasOne(Street::class, ['id' => 'street']);
    }

    // Get list of Property

    public function getPropertyType()
    {

        return $this->hasOne(PropertyType::class, ['id' => 'type']);
    }
}
