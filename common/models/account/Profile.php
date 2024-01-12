<?php

namespace common\models\account;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string $ref
 * @property string $first_name
 * @property string $last_name
 * @property string|null $middle_name
 * @property string $date_of_birth
 * @property int|null $age
 * @property string $gender
 * @property string|null $email
 * @property string $postal_address
 * @property string $nationality
 * @property string $nin
 * @property string|null $passport_no
 * @property int $user_id
 * @property string $profile_type
 * @property int $status
 * @property int $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ref', 'first_name', 'last_name', 'date_of_birth', 'gender', 'postal_address', 'nationality', 'nin', 'user_id', 'profile_type', 'status', 'created_at'], 'required'],
            [['age', 'user_id', 'status', 'created_at', 'created_by', 'updated_by'], 'integer'],
            [['updated_at'], 'safe'],
            [['ref'], 'string', 'max' => 225],
            [['first_name', 'last_name', 'middle_name'], 'string', 'max' => 200],
            [['date_of_birth'], 'string', 'max' => 10],
            [['gender'], 'string', 'max' => 25],
            [['email', 'postal_address', 'nationality', 'profile_type'], 'string', 'max' => 100],
            [['nin'], 'string', 'max' => 14],
            [['passport_no'], 'string', 'max' => 9],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref' => 'Ref',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
            'date_of_birth' => 'Date Of Birth',
            'age' => 'Age',
            'gender' => 'Gender',
            'email' => 'Email',
            'postal_address' => 'Postal Address',
            'nationality' => 'Nationality',
            'nin' => 'Nin',
            'passport_no' => 'Passport No',
            'user_id' => 'User ID',
            'profile_type' => 'Profile Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
