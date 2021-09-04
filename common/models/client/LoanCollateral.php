<?php

namespace common\models\client;

use Yii;
use common\models\client\MasterData;

/**
 * This is the model class for table "loan_collateral".
 *
 * @property int $id
 * @property int $loan_id
 * @property string $name
 * @property string $description
 * @property int $type_of_collateral
 * @property string|null $serial_number
 * @property float $estimated_price
 * @property string|null $proof_of_ownership
 * @property string $observation
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class LoanCollateral extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'loan_collateral';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['loan_id', 'name', 'description', 'type_of_collateral', 'estimated_price', 'created_at', 'created_by'], 'required'],
            [['loan_id', 'type_of_collateral','type_of_ownership', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['estimated_price'], 'number'],
            [['description', 'proof_of_ownership', 'location'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'loan_id' => 'Loan',
            'description' => 'Description',
            'type_of_collateral' => 'Type Of Collateral',
            'estimated_price' => 'Estimated Price',
            'proof_of_ownership' => 'Proof Of Ownership',
            'location' => 'Location',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    // Get Uploaded Loan Collateral

    public function getLoanCollateral() {
        if (!empty($this->proof_of_ownership)) {
            return Yii::getAlias('@web/html') . "/collateral/" . $this->proof_of_ownership;
        }
    }

    public function getCollateralType() {
        return $this->hasOne(MasterData::class, ['id' => 'type_of_collateral']);
    }

}
