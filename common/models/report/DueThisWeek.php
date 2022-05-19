<?php

namespace common\models\report;

use Yii;
use common\models\client\ClientMasterData;
use yii\helpers\Url;
use common\models\client\Loan;
use yii\helpers\Html;
/**
 * This is the model class for table "due_this_week".
 *
 * @property int $id
 * @property string|null $description
 * @property int $entry_reference Ref Number for this transaction. This Ref number is used to know the specific transactions which were handled together, e.g. assessment of taxheads (different taxheads) these should have the same ref number
 * @property float|null $amount
 * @property int|null $debit_account
 * @property int|null $credit_account
 * @property string|null $due_date Date when this payment is due
 * @property string|null $entry_type Is this a loan, payment, Investor deposit, etc?
 * @property int|null $entry_reference_id
 * @property string|null $stage
 * @property int $created_at
 * @property int|null $created_by
 * @property string|null $member_account
 * @property int|null $entry_period The accounting period for which this entry was made, could be a financial year e.g. 2021, calendar year like 2021 or Year-Month like 2101
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int $ledger_status
 * @property int|null $interest_status
 * @property string|null $cancel_interest_reason
 * @property int|null $payment_ref Payment reference for this ledger item
 */
class DueThisWeek extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'due_this_week';
    }

    public static function primaryKey() {
        return ['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'entry_reference', 'debit_account', 'credit_account', 'entry_reference_id', 'created_at', 'created_by', 'entry_period', 'updated_at', 'updated_by', 'ledger_status','payment_ref'], 'integer'],
            [['entry_reference', 'created_at'], 'required'],
            [['amount'], 'number'],
            [['due_date'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['entry_type', 'stage'], 'string', 'max' => 20],
            [['member_account'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'entry_reference' => 'Entry Reference',
            'amount' => 'Amount',
            'debit_account' => 'Debit Account',
            'credit_account' => 'Credit Account',
            'due_date' => 'Due Date',
            'entry_type' => 'Entry Type',
            'entry_reference_id' => 'Entry Reference ID',
            'stage' => 'Stage',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'member_account' => 'Member Account',
            'entry_period' => 'Entry Period',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'ledger_status' => 'Ledger Status',
            'interest_status' => 'Interest Status',
            'cancel_interest_reason' => 'Cancel Interest Reason',
            'payment_ref' => 'Payment Ref',
        ];
    }

    public function setEntryPeriod() {
        $this->entry_period = date('Y');
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
                            'disabled' => ($this->ledger_status > self::STATUS_NOTPAID)
        ]);
    }

    /**
     * Transaction formartted in UGX
     */
    public function getTransactionAmount() {
        return number_format($this->amount);
    }

    /**
     * Due Date formatted 
     */
    public function getTransactionDueDate() {
        return Yii::$app->formatter->asDate($this->due_date) . '</br><span style="color:#068;font-size:85%;">' . Yii::$app->formatter->asRelativeTime($this->due_date) . "</span>";
    }

    /**
     * Due Date formatted 
     */
    public function getTransactionDate() {
        return Yii::$app->formatter->asDate($this->created_at);
    }

    /**
     * Show Status Button 
     */
    public function getStatusButton() {
        return "<badge class='badge badge-{$this->ledgerStatus->css_class}'>" . $this->ledgerStatus->name . '</badge>';
    }

    /**
     * Status of the ledger record
     */
    public function getLedgerStatus() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'ledger_status']);
    }

    /**
     * Associated Loan 
     */
    public function getLoanLedger() {
        return $this->hasOne(Loan::class, ['id' => 'entry_reference_id']);
    }

    /**
     * Show Client Names 
     */
    public function getFullNames() {
        return $this->loanLedger->client->firstname . ' ' . $this->loanLedger->client->lastname;
    }

    /**
     * Get LOan Reference Number  Link
     */
    public function getReferenceNumber() {
        return '<b><a href="' . Url::to(['loan/view', 'id' => $this->id]) . '">' . $this->reference_number . "</a></b>";
    }

    public function getPassportPhoto() {
        if (!empty($this->client->assport_photo)) {
            return Yii::getAlias('@web/html') . "/passport/" . $this->loanLedger->client->passport_photo;
        } else {
            return Yii::getAlias('@web/html') . "/passport/default.jpeg";
        }
    }

    /**
     * 
     * Show Client Classification Status
     */
    public function getProfile() {
        $url = $this->passportPhoto;
        return Html::img($url, ['alt' => 'avatar', 'width' => '50', 'height' => '50']);
    }

    /**
     * Get Update Interest Status  Link
     */
    public function getInterestButton() {
        $my = $this->interest_status;
        if ($my == 42) {
            return '<b><a href="' . Url::to(['loan/update-interest', 'id' => $this->id, 'ln' => $this->loanLedger->id]) . '">' . 'Edit' . "</a></b>";
            //return $my;
        }
    }
    
      /**
     * Get Update Interest Status  Link
     */
    public function getPaymentButton() {
        $my = $this->ledger_status;
        if ($my == 42) {
            return '<b class="btn btn-success"><a href="' . Url::to(['loan/payment', 'id' => $this->id, 'ln' => $this->loanLedger->id]) . '">' . '<span style="color:#fff;font-size:85%;">Make Payment' . "</a></b>";
            //return $my;
        }
    }

    /**
     * Status of the ledger record
     */
    public function getInterestStatus() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'ledger_status']);
    }

    /**
     * Over due Payments
     */
    public static function getOverDuePayments() {
        $sql = "SELECT *
                FROM ledger
                WHERE (debit_account='11110' OR debit_account='12210') AND ledger_status=42 AND due_date < curdate() ORDER BY created_at ASC";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    /**
     * Over due Payments
     */
    public static function getOverTotalAmount() {
        $sql = "SELECT sum(amount)
                FROM ledger
                WHERE (debit_account='11110' OR debit_account='12210') AND ledger_status=42 AND due_date < curdate() ORDER BY created_at ASC";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

}
