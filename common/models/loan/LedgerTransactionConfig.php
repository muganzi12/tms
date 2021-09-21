<?php

namespace common\models\loan;

use Yii;
use common\models\client\ChartOfAccounts;
use common\models\client\LoanProduct;
/**
 * This is the model class for table "ledger_transaction_config".
 *
 * @property int $id
 * @property string $transaction_name
 * @property int $transaction_type
 * @property int $debit_account
 * @property int $credit_account
 * @property float|null $amount
 * @property string $amount_rule
 * @property int $is_primary
 * @property int $parent_id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_by
 * @property int|null $updated_at
 * @property string $product_type
 * @property string $product_id
 */
class LedgerTransactionConfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ledger_transaction_config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transaction_name', 'debit_account', 'credit_account', 'amount_rule', 'parent_id', 'created_at', 'created_by','product_id'], 'required'],
            [['debit_account', 'credit_account', 'is_primary', 'parent_id', 'created_at', 'created_by', 'updated_by', 'updated_at','product_id'], 'integer'],
            [['amount'], 'number'],
            [['amount_rule','product_type'], 'string'],
            [['transaction_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transaction_name' => 'Transaction Name',
            'debit_account' => 'Debit Account',
            'credit_account' => 'Credit Account',
            'amount' => 'Amount',
            'amount_rule' => 'Amount Calculation Method',
            'is_primary' => 'Is Primary Transaction',
            'parent_id' => 'Parent Transaction',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'product_type'=>'Product Type',
            'product_id'=>'Product'
        ];
    }

    public function getDebitAccount(){
        return $this->hasOne(ChartOfAccounts::class,['gl_code'=>'debit_account']);
    }

    public function getCreditAccount(){
        return $this->hasOne(ChartOfAccounts::class,['gl_code'=>'credit_account']);
    }

    /**
     * The Product (Loan, Investment, etc) to which this configuration is linked
     */
    public function getProduct(){
        $product='';
        switch($this->product_type){
            case 'LOAN';
            $loanProduct = LoanProduct::findOne($this->product_id);
            $product = $loanProduct->name;
            break;
            case 'INVESTMENT';
            break;
            case 'ADMIN';
            break;
        }
        return $product;
    }

    /**
     * Get the config rules for a loan product by Tag
     */
    public static function transactionByTag($product_id,$tag,$product='LOAN'){
        return LedgerTransactionConfig::find()
                ->where(['product_type'=>$product,'product_id'=>$product_id,'tags'=>$tag])
                ->all();
    }

}
