<?php

namespace common\models\client;

use Yii;
use common\models\client\MasterData;
use common\models\client\Client;
use common\models\client\LoanProduct;
use yii\db\ActiveRecord;
use common\models\client\LoanCollateralSearch;

/**
 * This is the model class for table "loan".
 *
 * @property int $id
 * @property string $reference_number
 * @property int $client_id Client ID
 * @property int $loan_type
 * @property float $amount_applied_for Loan Amount Requested by the Client
 * @property string $application_date
 * @property float|null $amount_approved
 * @property string|null $disbursment_date
 * @property int $status Loan Status
 * @property float $interest_rate
 * @property string $interest_frequency
 * @property string $installment_frequency
 * @property float|null $payment_installment_amount
 * @property string|null $installment_payment_start_date
 * @property string|null $installment_payment_last_date
 * @property string|null $interest_payment_start_date
 * @property string|null $interest_payment_last_date
 * @property int $loan_period
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Loan extends \yii\db\ActiveRecord {

    const SCENARIO_APPROVE = 'approve-loan-application';

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'loan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['reference_number', 'client_id', 'loan_type', 'amount_applied_for', 'currency', 'application_date', 'status', 'interest_rate', 'interest_frequency', 'installment_frequency', 'loan_period', 'created_at', 'created_by'], 'required'],
            [['client_id', 'loan_type', 'currency', 'status', 'amortization_method', 'loan_period', 'created_at', 'created_by', 'approved_by', 'approved_at', 'updated_at', 'updated_by'], 'integer'],
            [['amount_applied_for', 'amount_approved', 'interest_rate', 'payment_installment_amount'], 'number'],
            [['application_date', 'disbursment_date', 'installment_payment_start_date', 'installment_payment_last_date', 'interest_payment_start_date', 'interest_payment_last_date'], 'safe'],
            [['reference_number'], 'string', 'max' => 255],
            [['interest_frequency', 'installment_frequency'], 'string', 'max' => 20],
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_APPROVE] = ['amount_approved', 'amortization_method'];
        //$scenarios[self::SCENARIO_REGISTER] = ['username', 'email', 'password'];
        return $scenarios;
    }

    public function checkDate($attribute, $params) {
        $today = date('Y-m-d');
        $selectedDate = date($this->application_date);
        if ($selectedDate > $today) {
            $this->addError($attribute, 'Application Date Can not be greater than today!!');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'reference_number' => 'Reference Number',
            'client_id' => 'Client',
            'loan_type' => 'Loan Type',
            'amount_applied_for' => 'Amount',
            'currency' => "Currency",
            'application_date' => 'Application Date',
            'amount_approved' => 'Amount Approved',
            'disbursment_date' => 'Disbursment Date',
            'status' => 'Status',
            'interest_rate' => 'Interest Rate',
            'interest_frequency' => 'Interest Frequency',
            'installment_frequency' => 'Installment Frequency',
            'payment_installment_amount' => 'Payment Installment Amount',
            'installment_payment_start_date' => 'Installment Payment Start Date',
            'installment_payment_last_date' => 'Installment Payment Last Date',
            'interest_payment_start_date' => 'Interest Payment Start Date',
            'interest_payment_last_date' => 'Interest Payment Last Date',
            'amortization_method' => 'Amortization Method',
            'loan_period' => 'Loan Period',
            'created_at' => 'Applied On',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);
        $this->created_at = time();
        $this->created_by = Yii::$app->user->id;
        return true;
    }

    /**
     * Generate a reference NUmber
     */
    public function generateReferenceNumber() {
        $prefix = "LN" . date('y');
        return $prefix . time();
    }

    public function getLoanStatus() {
        return $this->hasOne(MasterData::class, ['id' => 'status']);
    }

    public function getLoanType() {
        return $this->hasOne(LoanProduct::class, ['id' => 'loan_type']);
    }

    public function getClient() {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
    }

    /**
     * Registration Documents presented by this client
     * @return CompanyDocument
     */
    public function getLoanGuarantor() {
        $searchModel = new LoanGuarantorSearch();
        $searchModel->loan_id = $this->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $dataProvider;
    }

}
