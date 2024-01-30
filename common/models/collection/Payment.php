<?php

namespace common\models\collection;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property int $property
 * @property int $property_unit
 * @property string $payment_date
 * @property float $amount
 * @property int $payment_channel
 * @property int $payment_mode
 * @property string $mobile_number
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['property', 'property_unit', 'payment_date', 'amount', 'payment_channel', 'payment_mode', 'mobile_number', 'status', 'created_at', 'created_by'], 'required'],
            [['property', 'property_unit', 'payment_channel', 'payment_mode', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['amount'], 'number'],
            [['payment_date'], 'string', 'max' => 20],
            [['mobile_number'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'property' => 'Property',
            'property_unit' => 'Property Unit',
            'payment_date' => 'Payment Date',
            'amount' => 'Amount',
            'payment_channel' => 'Payment Channel',
            'payment_mode' => 'Payment Mode',
            'mobile_number' => 'Mobile Number',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getProperty()
    {
        return $this->hasOne(Property::class, ['id' => 'property']);
    }
}
