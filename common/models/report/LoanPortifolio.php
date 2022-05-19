<?php

namespace common\models\report;

use Yii;
use common\models\client\Loan;
use common\models\User;
/**
 * This is the model class for table "loan_portifolio".
 *
 * @property int $loan_id
 * @property float|null $SUM(principal_amount)
 * @property float|null $SUM(principal_paid)
 * @property float|null $SUM(interest_amount)
 * @property float|null $SUM(interest_paid)
 * @property int $created_by
 * @property int $created_at
 */
class LoanPortifolio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loan_portifolio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loan_id', 'created_by', 'created_at'], 'required'],
            [['loan_id', 'created_by', 'created_at'], 'integer'],
            [['principal_amount', 'principal_paid', 'interest_amount', 'interest_paid'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'loan_id' => 'Loan ID',
            'principal_amount' => 'Principal Amount)',
            'principal_paid' => 'Principal Paid',
            'interest_amount' => 'Interest Amount)',
            'interest_paid' => 'Interest Paid',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
        ];
    }
    
      public function getLoan() {
        return $this->HasOne(Loan::class, ['id' => 'loan_id']);
    }
           public function getCreatedBy() {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }
}
