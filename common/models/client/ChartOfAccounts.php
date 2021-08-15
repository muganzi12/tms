<?php

namespace common\models\client;

use Yii;
use common\models\client\MasterData;
use common\models\client\ChartOfAccounts;
/**
 * This is the model class for table "chart_of_accounts".
 *
 * @property int $id
 * @property int $parent_id Header Account Type
 * @property int $gl_code General Ledger Code
 * @property string $account_name Account Name
 * @property int $account_type Is it an Asset,Equity,Expense,Income or Liability?
 * @property string $description
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class ChartOfAccounts extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'chart_of_accounts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['gl_code', 'account_name','category', 'account_type', 'description', 'created_at', 'created_by'], 'required'],
            [['parent_id', 'gl_code', 'account_type', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['account_name','category'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'parent_id' => 'Header',
            'gl_code' => 'General Ledger Code',
            'account_name' => 'Account Name',
            'account_type' => 'Account Type',
            'description' => 'Description',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    //Select Header type from the chart_of_accounts table from the masterdata db  
    public function getHeaderType() {
        return $this->hasOne(ChartOfAccounts::class, ['id' => 'parent_id']);
    }
    
      public function getType() {
        return $this->hasOne(MasterData::class, ['id' => 'account_type']);
    }
    
      public static function getGlCode() {
        return ChartOfAccounts::find()->select(['gl_code'])->one();
    }
    
      /**
     * Generate Detail GL Code
     */
    public function generateGlCode() {
        $pref = self::getGlCode()['gl_code'];
        //$prefix = strtoupper(substr($pref, 0, 3));
        return $pref;
    }

}
