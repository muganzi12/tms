<?php

namespace common\models\loan;

use Yii;

/**
 * This is the model class for table "ledger_transaction_type".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $is_split
 * @property int $module_id
 * @property int $created_by
 * @property int $created_at
 * @property int|null $updated_by
 * @property int|null $updated_at
 */
class LedgerTransactionType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ledger_transaction_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'is_split', 'module_id', 'created_by', 'created_at'], 'required'],
            [['is_split', 'module_id', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
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
            'description' => 'Description',
            'is_split' => 'Is Split',
            'module_id' => 'Module ID',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }
}
