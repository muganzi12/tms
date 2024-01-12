<?php

namespace common\models\location;

use common\models\location\District;
use common\models\location\Division;
use Yii;

/**
 * This is the model class for table "parish".
 *
 * @property int $id
 * @property string $name
 * @property int $municipality
 * @property int $division
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Parish extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parish';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'municipality', 'division', 'created_at', 'created_by'], 'required'],
            [['municipality', 'division', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
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
}
