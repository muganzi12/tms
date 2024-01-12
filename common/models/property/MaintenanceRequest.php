<?php

namespace common\models\property;

use Yii;

/**
 * This is the model class for table "maintenance_request".
 *
 * @property int $id
 * @property int $property_id
 * @property int $unit
 * @property string|null $request_date
 * @property int $maintainer
 * @property int $issue_type
 * @property int $status
 * @property string|null $attachment
 * @property string $notes
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class MaintenanceRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'maintenance_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['property_id', 'unit', 'maintainer', 'issue_type', 'status', 'notes', 'created_at', 'created_by'], 'required'],
            [['property_id', 'unit', 'maintainer', 'issue_type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['notes'], 'string'],
            [['request_date'], 'string', 'max' => 100],
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
            'property_id' => 'Property ID',
            'unit' => 'Unit',
            'request_date' => 'Request Date',
            'maintainer' => 'Maintainer',
            'issue_type' => 'Issue Type',
            'status' => 'Status',
            'attachment' => 'Attachment',
            'notes' => 'Notes',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
