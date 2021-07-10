<?php

namespace common\models\member;

use Yii;

/**
 * This is the model class for table "next_of_kin".
 *
 * @property int $id
 * @property int|null $member_id
 * @property string $firstname
 * @property string $lastname
 * @property string $middle_name
 * @property string $gender
 * @property int $relationship
 * @property string $date_of_birth
 * @property string $address
 * @property string $phone_number
 * @property int $is_existing_client
 * @property int|null $client_id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
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
            [['member_id', 'relationship', 'client_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['firstname', 'lastname', 'gender', 'relationship', 'date_of_birth', 'address', 'phone_number', 'is_existing_client', 'created_at', 'created_by'], 'required'],
            [['date_of_birth'], 'safe'],
            [['firstname', 'lastname', 'middle_name'], 'string', 'max' => 100],
            [['gender'], 'string', 'max' => 45],
            [['address'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 13],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => 'Member ID',
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'middle_name' => 'Middle Name',
            'gender' => 'Gender',
            'relationship' => 'Relationship',
            'date_of_birth' => 'Date Of Birth',
            'address' => 'Address',
            'phone_number' => 'Phone Number',
            'is_existing_client' => 'Is Existing Client',
            'client_id' => 'Client ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
