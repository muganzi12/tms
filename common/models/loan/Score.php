<?php

namespace common\models\loan;

use Yii;
use common\models\loan\RatedItem;
use common\models\loan\Guadge;
use common\models\client\Loan;
/**
 * This is the model class for table "score".
 *
 * @property int $id
 * @property int $client_item_id
 * @property int $rate_item_id
 * @property float $mark
 * @property string $reason
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Score extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'score';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'rate_item_id','guadge_score_id', 'loan_id','reason', 'created_at', 'created_by'], 'required'],
            [['client_id', 'rate_item_id','loan_id', 'created_at','guadge_score_id', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['mark'], 'number'],
            [['reason'], 'string', 'max' => 5000],
        ];
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
            $this->mark=$this->item->marks*$this->guadge->marks;
            $this->updated_by = Yii::$app->member->id;
        }
    return parent::beforeSave($insert);
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client',
            'rate_item_id' => 'Rated Item',
             'guadge_score_id' => 'Rate',
            'mark' => 'Mark',
            'reason' => 'Reason',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
       /**
     * Associated Loan 
     */
    public function getItem() {
        return $this->hasOne(RatedItem::class, ['id' => 'rate_item_id']);
    }
    
    public function getGuadge() {
        return $this->hasOne(Guadge::class, ['id' => 'guadge_score_id']);
    }
    
     public function getLoan() {
        return $this->hasOne(Loan::class, ['id' => 'loan_id']);
    }
}
