<?php

namespace common\models\masterdata;

use Yii;
use common\models\masterdata\MasterData;
/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $reference_number
 * @property string $name
 * @property int $brn
 * @property string $contact_person
 * @property string $office_telephone
 * @property string $mobile_tephone
 * @property string $email
 * @property string|null $website
 * @property string $address
 * @property int $status
 * @property string|null $logo_pic
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Company extends \yii\db\ActiveRecord {

    
        public static function getDb() {
        parent::getDb();
        return Yii::$app->masterdb;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'contact_person', 'office_telephone', 'mobile_tephone', 'email', 'address','code', 'status', 'created_at', 'created_by'], 'required'],
            [['brn', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['logo_pic'], 'string', 'max' => 255],
            [['name', 'contact_person', 'email', 'website'], 'string', 'max' => 100],
            [['office_telephone', 'mobile_tephone'], 'string', 'max' => 14],
            [['address'], 'string', 'max' => 500],
            [['name'], 'unique', 'message' => 'This Client has already been registered .'],
            [['brn'], 'unique', 'message' => 'This BRN has already been registered with another Client .'],
            [['office_telephone'], 'unique', 'message' => 'This Office telephone already been used .'],
            [['mobile_tephone'], 'unique', 'message' => 'This Mobile telephone already been used .'],
            [['email'], 'unique', 'message' => 'This email has already been used.'],
            [['code'], 'unique', 'message' => 'This code has already been used.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'brn' => 'Brn',
            'contact_person' => 'Contact Person',
            'office_telephone' => 'Office Telephone',
            'mobile_tephone' => 'Mobile Tephone',
            'email' => 'Email',
            'website' => 'Website',
            'address' => 'Address',
            'status' => 'Status',
            'logo_pic' => 'Logo Pic',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getClientStatus() {
        return $this->hasOne(MasterData::class, ['id' => 'status']);
    }

}
