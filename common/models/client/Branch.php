<?php

namespace common\models\client;

use Yii;
use common\models\masterdata\MasterData;
/**
 * This is the model class for table "branch".
 *
 * @property int $id
 * @property string $name
 * @property int $client_id
 * @property string $mobile_telephone
 * @property string $office_telephone
 * @property string $address
 * @property int|null $status
 * @property int $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','mobile_telephone', 'office_telephone', 'address', 'created_at', 'created_by'], 'required'],
            [['status', 'created_at', 'created_by'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['mobile_telephone', 'office_telephone', 'updated_at', 'updated_by'], 'string', 'max' => 45],
            [['address'], 'string', 'max' => 225],
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
            'mobile_telephone' => 'Mobile Telephone',
            'office_telephone' => 'Office Telephone',
            'address' => 'Address',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    
      public function getBranchStatus() {
        return $this->hasOne(MasterData::class, ['id' => 'status']);
    }

}
