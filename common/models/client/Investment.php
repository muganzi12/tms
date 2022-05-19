<?php

namespace common\models\client;

use Yii;
use yii\helpers\Url;
use common\models\client\Investor;
use common\models\loan\Ledger;
use common\models\loan\DecliningBalanceAmortization;

/**
 * This is the model class for table "investment".
 *
 * @property int $id
 * @property int $investor_id
 * @property int $loan_product
 * @property float $amount_to_invest
 * @property float $investment_duration
 * @property float $interest_rate
 * @property float $total_interest
 * @property float $expected_total_amount
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Investment extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'investment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['investor_id', 'reference_number', 'loan_type', 'amount_to_invest', 'status', 'payment_frequency', 'investment_duration', 'interest_rate', 'created_at', 'created_by'], 'required'],
            [['investor_id', 'created_at', 'created_by', 'status', 'updated_at', 'updated_by'], 'integer'],
            [['amount_to_invest', 'investment_duration', 'interest_rate'], 'number'],
            [['proof_of_investment'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'reference_number' => 'Reference Number',
            'investor_id' => 'Investor',
            'payment_frequency' => 'Payment Frequency',
            'amount_to_invest' => 'Amount',
            'investment_duration' => 'Duration',
            'interest_rate' => 'Interest Rate',
            'created_at' => 'Created At',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Get Investment Reference Number  Link
     */
    public function getReferenceNumber() {
        return '<b><a href="' . Url::to(['investor/investment-details', 'id' => $this->id]) . '">' . $this->reference_number . "</a></b>";
    }

    /**
     * Amount Applied
     */
    public function getInvestmentAmount() {
        return number_format($this->amount_to_invest);
    }

    /**
     * 
     * @return type Investment status
     */
    public function getInvestmentStatus() {
        return $this->hasOne(ClientMasterData::class, ['id' => 'status']);
    }

    /**
     * Show Status Button 
     */
    public function getStatusButton() {
        return "<badge class='badge badge-{$this->investmentStatus->css_class}'>" . $this->investmentStatus->name . '</badge>';
    }

    public function getLedgerEntries() {
        return $this->hasMany(Ledger::class, ['entry_reference_id' => 'id'])->where(['entry_type' => "INVESTMENT"]);
    }

    /**
     * Get Investor 
     */
    public function getInvestor() {
        return $this->hasOne(Investor::class, ['id' => 'investor_id']);
    }

    public function getCalculateInterest($method = 1) {

        switch ($method) {

            case 1: //Straight Line

                $schedule = new LoanAmortization();

                $schedule->setPrincipal($this->amount_approved); //Principal

                $schedule->setTerm($this->investment_duration); //Number of months

                $schedule->setInterestRate($this->interest_rate / 100); //Interest Rate

                return $schedule->getBreakdownByMonth();

                break;

            case 2: //Reducing Balance

                $schedule = new DecliningBalanceAmortization(
                        [
                    'months' => $this->investment_duration,
                    'amount_disbursed' => $this->amount_to_invest,
                    'interest_rate' => ($this->interest_rate / 100),
                    'start_date' => "2021-10-23" //$this->disbursment_date
                ]);

                return $schedule->getBreakdownByMonth();

                break;
        }
    }

}
