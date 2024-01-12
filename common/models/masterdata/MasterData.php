<?php

namespace common\models\masterdata;

use Yii;

/**
 * This is the model class for table "master_data".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $created_by
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $updated_by
 * @property string|null $reference_table Table to which this status is applicable
 * @property int|null $parent_id
 * @property string|null $css_class
 */
class MasterData extends \yii\db\ActiveRecord
{

    public static function getDb()
    {
        parent::getDb();
        return Yii::$app->db;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_by'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'reference_table'], 'string', 'max' => 225],
            [['created_by', 'updated_by', 'css_class'], 'string', 'max' => 45],
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
            'description' => 'Description',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'reference_table' => 'Reference Table',
            'css_class' => 'Css Class',
        ];
    }
}
