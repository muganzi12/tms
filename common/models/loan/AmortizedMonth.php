<?php
namespace common\models\loan;

use \DateTime;
use JsonSerializable;

class AmortizedMonth implements JsonSerializable
{
    /**
     * @var float
     */
    private $principalDue;
    
    /**
     * @var float
     */
    private $interestDue;
    
    /**
     * @var array|Overpayment[]
     */
    private $overpayments = [];
    
    /**
     * @var DateTime
     */
    private $date;
    
    /**
     * @var float
     */
    private $openingBalance;
    
    /**
     * @var float
     */
    private $closingBalance;
    
    /**
     * @param DateTime $date
     * @param float $principalDue
     * @param float $interestDue
     */
    public function __construct(DateTime $date, float $principalDue = 0.0, float $interestDue = 0.0)
    {
        $this->date = $date;
        $this->principalDue = round($principalDue, 2);
        $this->interestDue = round($interestDue, 2);
    }
    
    public function getTotalAmountDue(): float
    {
        return round($this->principalDue + $this->interestDue, 2);
    }
    
    /**
     * @param array $overpayments
     * @return AmortizedMonth
     */
    public function setOverpayments(array $overpayments): AmortizedMonth
    {
        $this->overpayments = [];
        array_walk($overpayments, [$this, 'addOverpayment']);
        return $this;
    }
    
    /**
     * @return float
     */
    public function getTotalOverpayments(): float
    {
        return round(array_reduce($this->overpayments, function(float $carry, Overpayment $overpayment) {
            return $carry + $overpayment->getAmount();
        }, 0.0), 2);
    }
    
    /**
     * @param float $balance
     * @return AmortizedMonth
     */
    public function setOpeningBalance(float $balance): AmortizedMonth
    {
        $this->openingBalance = $balance;
        return $this;
    }
    
    /**
     * @param float $balance
     * @return AmortizedMonth
     */
    public function setClosingBalance(float $balance): AmortizedMonth
    {
        $this->closingBalance = $balance;
        return $this;
    }
    
    /**
     * @param Overpayment $overpayment
     */
    private function addOverpayment(Overpayment $overpayment)
    {
        $this->overpayments[] = $overpayment;
    }

    /**
    * Round up to the nearest hundres
    */
    function roundNearestHundredUp($number)
    {
        return ceil( $number / 100 ) * 100;
    }

    /**
     * Round down to the nearest hundred
     */
    function roundNearestHundredDown($number)
    {
        return floor( $number / 100 ) * 100;
    }
    
    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'totalPayment'=>round(($this->interestDue+$this->principalDue),2),
            'totalPaymentRounded'=>$this->roundNearestHundredUp($this->interestDue+$this->principalDue),
            'interestDue' => round($this->interestDue, 2),
            'interestRounded'=>$this->roundNearestHundredUp($this->interestDue),
            'principalDue' => round($this->principalDue, 2),
            'principalRounded'=>$this->roundNearestHundredUp($this->principalDue),
            'openingBalance' => round($this->openingBalance, 2),
            'closingBalance' => round($this->closingBalance, 2),
            'overpayments'   => $this->overpayments,
            'date' => $this->date->format('Y-m-d'),
        ];
    }
}