<?php
namespace common\models\loan;

use Yii;
use yii\base\Model;
	/**
	 * Declining Balance Loan Amortization Method
	 */
	class DecliningBalanceAmortization extends Model
	{

    /**
     * @var int
     */
    public $months = 0;

        public function getTheCurrentInterval($interval){
        $finalInterval = 0;
        if($interval%4 == 0){
            $finalInterval = $interval/4;
        }else{
            $finalInterval = floor($interval/4);
        }
        return $finalInterval;
    }
    /**
     * @var float
     */
    public $amount_disbursed = 0;

    /**
     * @var float
     */
    public $interest_rate = 0;

    /**
     * @var DateTime
     */
    public $start_date;


    public function __construct($config=[]){
        parent::__construct($config);
        $this->setLoanAttributes();
    }

    protected function setLoanAttributes(){
       $this->start_date = strtotime($this->start_date);
    }

  
       /**
     * Amount of principal to be paid every month
     */
    public function getWeeklyPrincipalPayment() {
        return round($this->amount_disbursed / ($this->months * 4), 2);
    }

    /**
     * Amount of principal to be paid every month
     */
    public function getMonthlyPrincipalPayment() {
        return round($this->amount_disbursed / $this->months, 2);
    }
    
        public function getMonthlyInstallmentPayment(){
        return 0.08* -$this->amount_disbursed * pow((1 + 0.08), $this->months) / (1 - pow((1 + 0.08),$this->months));
    }


     /**
     * Build the payment schedule
     * @return array|AmortizedMonth[]
     * @throws Exception
     */
    public function getBreakdownByMonth() {
        $months = [];
        $flag = "";
        $payments[0] = [
            'ref' => 0,
            'opening_balance' => $this->amount_disbursed,
            'principal' => 0,
            'interest' => 0,
            'due_date' => date("Y-m-d", $this->start_date)
        ];
        //Go through each month

        ///CONVERT MONTHS TO WEEKS EACH OF 4WEEKS
           // $_principal = $this->monthlyPrincipalPayment;
            $payments[1] = [
                'ref' => 1,
                'due_date' => date("Y-m-d", strtotime("+4 week", $this->start_date)),
                'opening_balance' => $payments[0]['opening_balance'] - ($this->monthlyInstallmentPayment-$payments[0]['opening_balance']*$this->interest_rate),
                'principal' => ($this->monthlyInstallmentPayment-$payments[0]['opening_balance']*$this->interest_rate),
                'interest_rate' => $this->interest_rate,
                'interest' => $payments[0]['opening_balance'] * $this->interest_rate
            ];

        $weeks = ($this->months * 4) - 4;
        for ($i = 1; $i <= $weeks; $i++) {
           // $_principal = $this->weeklyPrincipalPayment;
            $nowTime = $i+4;
            $payments[$i+1] = [
                'ref' => $i+1,
                'due_date' => date("Y-m-d", strtotime("+{$nowTime} week", $this->start_date)),
                'interest' => $payments[$this->getTheCurrentInterval($i)]['opening_balance'] * $this->interest_rate/4,
                'opening_balance' => ($payments[$this->getTheCurrentInterval($i)]['opening_balance'] - ($this->monthlyInstallmentPayment-$payments[$this->getTheCurrentInterval($i)]['opening_balance']*$this->interest_rate)),
                'principal' => ($this->monthlyInstallmentPayment-$payments[$this->getTheCurrentInterval($i)]['opening_balance']*$this->interest_rate)/4,
                'interest_rate' => $this->interest_rate,
            ];

        }

        //Create instances of Armotized Month
        array_shift($payments); //Remove first item
        foreach ($payments AS $pay) {
            $month = new AmortizedMonth(new \DateTime($pay['due_date']), $pay['principal'], $pay['interest']);

            $month->setOpeningBalance($pay['opening_balance']);
            //$month->setOverpayments(0);
            $months[] = $month;
            $month->setClosingBalance($pay['opening_balance']);
        }

        //List of payments
        return $months;
    }
  
}
