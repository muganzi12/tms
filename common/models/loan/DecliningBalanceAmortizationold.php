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
    public function getMonthlyPrincipalPayment(){
        return $this->amount_disbursed/$this->months;
    }
    
    
     public function getMonthlyInstallmentPayment(){
        return 0.08* -$this->amount_disbursed * pow((1 + 0.08), $this->months) / (1 - pow((1 + 0.08),$this->months));
    }

    /**
     * Build the payment schedule
     * @return array|AmortizedMonth[]
     * @throws Exception
     */
    public function getBreakdownByMonth(){
        $months=[];
        $payments[0]=[
                 'ref'=>0,
                 'opening_balance'=>$this->amount_disbursed,
                 'principal'=>0,
                 'interest'=>0,
                 'due_date'=>date("Y-m-d",$this->start_date)
             ];
        //Go through each month
        for($i=1;$i<=$this->months;$i++){
            //$_installment = $this->monthlyInstallmentPayment;
            //$_principal= $_installment-
            $payments[$i]=[
                'ref'=>$i,
                'due_date'=>date("Y-m-d", strtotime("+{$i} month", $this->start_date)),
                'interest'=>$payments[$i-1]['opening_balance']*$this->interest_rate,
                'opening_balance'=>($payments[$i-1]['opening_balance'])-($this->monthlyInstallmentPayment-$payments[$i-1]['opening_balance']*$this->interest_rate),
                'principal'=>($this->monthlyInstallmentPayment-$payments[$i-1]['opening_balance']*$this->interest_rate),
                'interest_rate'=>$this->interest_rate,
               
            ];
        }

        //Create instances of Armotized Month
        array_shift($payments);//Remove first item
        foreach($payments AS $pay){
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
