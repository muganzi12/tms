<?php

namespace common\models\report;

use Yii;
use common\models\client\ClientMasterData;
use yii\helpers\Url;
use common\models\client\Loan;
use yii\helpers\Html;

/**
 * This is the model class for table "aging_report".
 *
 * @property int $id
 * @property string $description
 * @property int $entry_reference Ref Number for this transaction. This Ref number is used to know the specific transactions which were handled together, e.g. payment of a loan (principle and interest) these should have the same ref number
 * @property float $amount
 * @property int $debit_account
 * @property int|null $credit_account
 * @property string|null $due_date Date when this payment is due
 * @property string|null $next_date
 * @property string $entry_type Is this a loan, payment, Investor deposit, etc?
 * @property int $entry_reference_id
 * @property int|null $schedule_id
 * @property int $created_at
 * @property int|null $created_by
 * @property string|null $member_account
 * @property int|null $entry_period The accounting period for which this entry was made, could be a financial year e.g. 2021, calendar year like 2021 or Year-Month like 2101
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $ledger_status
 * @property int|null $payment_ref Payment reference for this ledger item
 * @property string|null $stage
 * @property int $sub_legder
 */
class AgingReport extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'aging_report';
    }

    public static function primaryKey() {
        return ['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'entry_reference', 'debit_account', 'credit_account', 'entry_reference_id', 'schedule_id', 'created_at', 'created_by', 'entry_period', 'updated_at', 'updated_by', 'ledger_status', 'payment_ref', 'sub_legder'], 'integer'],
            [['description', 'entry_reference', 'amount', 'debit_account', 'entry_type', 'entry_reference_id', 'created_at'], 'required'],
            [['amount'], 'number'],
            [['due_date', 'next_date'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['entry_type'], 'string', 'max' => 20],
            [['member_account', 'stage'], 'string', 'max' => 45],
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
            'next_date' => 'Next Date',
            'entry_type' => 'Entry Type',
            'entry_reference_id' => 'Entry Reference ID',
            'schedule_id' => 'Schedule ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'member_account' => 'Member Account',
            'entry_period' => 'Entry Period',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'ledger_status' => 'Ledger Status',
            'payment_ref' => 'Payment Ref',
            'stage' => 'Stage',
            'sub_legder' => 'Sub Legder',
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
    public function getStatusButton() {
        $date = $this->due_date;
        $today = time();
        $difference = idate('y',$today);
        if ($difference <= 30) {
            return '<b class="btn btn-success">' . 'Normal' . "</a></b>";
            //return $my;
        } elseif ($difference = 60) {
            return '<b class="btn btn-success">' . 'Watchfull' . "</a></b>";
        } elseif ($difference = 90) {
            return '<b class="btn btn-success">' . 'Doubtfull' . "</a></b>";
        } else {
            return '<b class="btn btn-success">' . 'Loss' . "</a></b>";
        }
    }


}
