<?php

namespace common\models\location;

use common\models\location\District;
use common\models\location\Division;
use common\models\location\Parish;
use common\models\location\Village;
use Yii;

/**
 * This is the model class for table "street".
 *
 * @property int $id
 * @property string $name
 * @property int $municipality
 * @property int $division
 * @property int $parish
 * @property int $village
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Street extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'street';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'municipality', 'division', 'parish', 'village', 'created_at', 'created_by'], 'required'],
            [['municipality', 'division', 'parish', 'village', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
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
            'municipality' => 'Municipality',
            'division' => 'Division',
            'parish' => 'Parish',
            'village' => 'Village',
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

    // Get list of Parishes

    public function getVillageName()
    {

        return $this->hasOne(Village::class, ['id' => 'parish']);
    }
}
