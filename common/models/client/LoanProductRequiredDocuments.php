<?php

namespace common\models\client;

use Yii;

/**
 * This is the model class for table "loan_product_required_documents".
 *
 * @property int $id
 * @property int $loan_product_id
 * @property string $name
 * @property string $description
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class LoanProductRequiredDocuments extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'loan_product_required_documents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['loan_product_id', 'is_required', 'name', 'description', 'created_at', 'created_by'], 'required'],
            [['loan_product_id', 'is_required', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'loan_product_id' => 'Loan Product ID',
            'name' => 'Name',
            'description' => 'Description',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

}
