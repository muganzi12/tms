<?php

namespace common\models\client;

use Yii;
use common\models\client\Loan;
use common\models\client\Client;
use common\models\User;
/**
 * This is the model class for table "loan_manager_remarks".
 *
 * @property int $id
 * @property int|null $loan_id
 * @property int|null $client_id
 * @property string $category
 * @property string $remarks
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class LoanManagerRemarks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loan_manager_remarks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loan_id','client_id','investment_id', 'remarks_status','created_at','submitted_to', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['category', 'remarks','remarks_status', 'created_at', 'created_by','submitted_to'], 'required'],
            [['category'], 'string', 'max' => 20],
            [['remarks'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loan_id' => 'Loan ID',
            'client_id' => 'Client ID',
            'category' => 'Category',
            'remarks' => 'Remarks',
            'submitted_to'=>'Submitted To',
            'remarks_status'=>'Remarks',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    
        public function getLoan() {
        return $this->hasOne(Loan::class, ['id' => 'loan_id']);
    }
    
     public function getClient() {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
    }
    
       public function getCreatedBy() {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }
    
    
    public function getSubmittedTo() {
        return $this->hasOne(User::class, ['id' => 'submitted_to']);
    }
    
    
}
