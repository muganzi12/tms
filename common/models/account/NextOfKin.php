<?php

namespace common\models\account;

use Yii;

/**
 * This is the model class for table "next_of_kin".
 *
 * @property int $id
 * @property int $tenant_id
 * @property string $first_name
 * @property string $surname
 * @property string|null $middle_name
 * @property string $physical_address
 * @property string $occupation
 * @property string $mobile_number
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 */
class NextOfKin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'next_of_kin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tenant_id', 'first_name', 'surname', 'physical_address', 'occupation', 'mobile_number', 'email', 'status', 'created_at', 'created_by'], 'required'],
            [['tenant_id', 'status', 'created_at', 'created_by', 'updated_by'], 'integer'],
            [['updated_at'], 'safe'],
            [['first_name', 'surname', 'middle_name', 'physical_address', 'occupation', 'mobile_number', 'email'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tenant_id' => 'Tenant ID',
            'first_name' => 'First Name',
            'surname' => 'Surname',
            'middle_name' => 'Middle Name',
            'physical_address' => 'Physical Address',
            'occupation' => 'Occupation',
            'mobile_number' => 'Mobile Number',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
