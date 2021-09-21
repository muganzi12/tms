<?php

namespace common\models\loan;

use Yii;
use yii\helpers\Html;
use common\models\client\MasterData;

/**
 * This is the model class for table "ledger".
 *
 * @property int $id
 * @property int $entry_reference Ref Number for this transaction. This Ref number is used to know the specific transactions which were handled together, e.g. payment of a loan (principle and interest) these should have the same ref number
 * @property float $amount
 * @property string $debit_account
 * @property string $credit_account
 * @property int $entry_type Is this a loan, payment, Investor deposit, etc?
 * @property int $entry_reference_id
 * @property int $created_at
 * @property int|null $created_by
 * @property string|null $member_account
 * @property int|null $entry_period The accounting period for which this entry was made, could be a financial year e.g. 2021, calendar year like 2021 or Year-Month like 2101
 **/
class Ledger extends \yii\db\ActiveRecord
{
    const STATUS_NOTPAID=42;
    const STATUS_PAID=43;
    const STATUS_CANCELLED=44;
    const STATUS_REVERSED=45;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ledger';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'debit_account', 'credit_account', 'entry_type', 'entry_reference_id'], 'required'],
            [['entry_reference', 'entry_type', 'entry_reference_id', 'created_at', 'created_by', 'entry_period','updated_at','updated_by','ledger_status'], 'integer'],
            [['amount'], 'number'],
            [['due_date'], 'safe'],
            [['debit_account', 'credit_account', 'member_account'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert){
        if($this->isNewRecord){
            $this->setEntryPeriod();
            $this->created_at = time();
            $this->created_by = Yii::$app->member->id;
        }else{
            $this->updated_at = time();
            $this->updated_by = Yii::$app->member->id;
        }
    return parent::beforeSave($insert);
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entry_reference' => 'Entry Reference',
            'amount' => 'Amount',
            'debit_account' => 'Debit Account',
            'credit_account' => 'Credit Account',
            'entry_type' => 'Entry Type',
            'entry_reference_id' => 'Entry Reference ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'member_account' => 'Member Account',
            'entry_period' => 'Entry Period',
            'updated_at'=>'Last updated at',
            'updated_by'=>'Last updated by',
            'ledger_status'=>'Status',
            'due_date'=>'Due Date'
        ];
    }

    public function setEntryPeriod(){
        $this->entry_period=date('Y');
    }

    /**
     * Chckebox field used for the first column
     * @return type
     */
    public function getCheckboxField() {
            return Html::checkbox('row' . $this->id, false, 
            [
                'label' => false, 
                'id' => 'row' . $this->id, 
                'value' => $this->id,
                'disabled'=>($this->ledger_status>self::STATUS_NOTPAID)
            ]);
    }

    /**
     * Transaction formartted in UGX
     */
    public function getTransactionAmount(){
        return Yii::$app->formatter->asCurrency($this->amount,'UGX');
    }
    
    /**
    * Due Date formatted 
    */
    public function getTransactionDueDate(){
        return Yii::$app->formatter->asDate($this->due_date).'</br><span style="color:#068;font-size:85%;">'.Yii::$app->formatter->asRelativeTime($this->due_date)."</span>";
    }

    /**
    * Due Date formatted 
    */
    public function getTransactionDate(){
        return Yii::$app->formatter->asDate($this->created_at);
    }

    /**
    * Show Status Button 
    */
    public function getStatusButton(){
        return "<badge class='badge badge-{$this->ledgerStatus->css_class}'>".$this->ledgerStatus->name.'</badge>';
    }

    /**
     * Status of the ledger record
     */
    public function getLedgerStatus() {
        return $this->hasOne(MasterData::class, ['id' => 'ledger_status']);
    }
    
}
