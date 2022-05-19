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
        $this->principalDue = $principalDue;
        $this->interestDue = $interestDue;
    }
    
    public function getTotalAmountDue(): float
    {
        return $this->principalDue + $this->interestDue;
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
            'totalPayment'=>$this->interestDue+$this->principalDue,
            'totalPaymentRounded'=>$this->interestDue+$this->principalDue,
            'interestDue' => $this->interestDue,
            'interestRounded'=>$this->interestDue,
            'principalDue' => $this->principalDue,
            'principalRounded'=>$this->principalDue,
            'openingBalance' => $this->openingBalance,
            'closingBalance' => $this->closingBalance,
            'overpayments'   => $this->overpayments,
            'date' => $this->date->format('Y-m-d'),
        ];
    }
}