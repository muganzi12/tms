<?php

namespace common\models\loan;

use Yii;
use common\models\User;
/**
 * This is the model class for table "transaction_payments".
 *
 * @property int $id
 * @property int $loan_id
 * @property float $amount
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class TransactionPayments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaction_payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loan_id', 'amount', 'created_at', 'created_by'], 'required'],
            [['loan_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loan_id' => 'Loan ID',
            'amount' => 'Amount',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    
        /**
    * Due Date formatted 
    */
    public function getTransactionDate(){
        return Yii::$app->formatter->asDate($this->created_at);
    }
       public function getTransactionAmount(){
        return number_format($this->amount);
    }
    
              public function getCreatedBy() {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }
    
      public function getPaidBy() {
        return $this->createdBy->firstname . ' ' . $this->createdBy->lastname;
    }
    
}
