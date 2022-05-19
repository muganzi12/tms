<?php

namespace common\models\loan;

use Yii;
use common\models\loan\BorrowRequirements;
use common\models\client\Loan;
/**
 * This is the model class for table "borrower_check_list".
 *
 * @property int $id
 * @property int $client_id
 * @property int $loan_id
 * @property int $requirement_id
 * @property string $category
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class BorrowerCheckList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'borrower_check_list';
    }
    
         /**
     * {@inheritdoc}
     */
    public function beforeSave($insert){
        if($this->isNewRecord){
            $this->created_at = time();
            $this->created_by = Yii::$app->member->id;
        }else{
            $this->updated_at = time();
            $this->updated_by = Yii::$app->member->id;
        }
    return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'loan_id', 'requirement_id','status', 'category', 'created_at', 'created_by'], 'required'],
            [['client_id', 'loan_id', 'requirement_id', 'status','created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['category','rate'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client',
            'loan_id' => 'Loan ID',
            'requirement_id' => 'Requirement',
            'category' => 'Category',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    
    
           /**
     * Associated Loan 
     */
    public function getRequirement() {
        return $this->hasOne(BorrowRequirements::class, ['id' => 'requirement_id']);
    }
    
  
    
     public function getLoan() {
        return $this->hasOne(Loan::class, ['id' => 'loan_id']);
    }
}
