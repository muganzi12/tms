<?php

namespace common\models\sacco;

use Yii;

/**
 * This is the model class for table "sacco".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $website
 * @property string $telephone
 * @property string $address
 * @property int|null $brn
 * @property int|null $tin
 * @property string|null $certificate_no
 * @property string $reference_no
 * @property int $created_at
 * @property int|null $updated_at
 * @property int $created_by
 * @property int|null $updated_by
 */
class Sacco extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sacco';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'telephone', 'address','created_at', 'created_by'], 'required'],
            [['brn', 'tin', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'email', 'website', 'address'], 'string', 'max' => 255],
            [['telephone', 'certificate_no', 'reference_no'], 'string', 'max' => 45],
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
            'email' => 'Email',
            'website' => 'Website',
            'telephone' => 'Telephone',
            'address' => 'Address',
            'brn' => 'Brn',
            'certificate_no' => 'Certificate No',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
