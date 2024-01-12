<?php

namespace common\models\account;

use Yii;

/**
 * This is the model class for table "auth_assignment".
 *
 * @property int $id
 * @property string $item_name
 * @property string $user_id
 * @property int $created_at
 */
class AuthAssignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id', 'created_at'], 'required'],
            [['created_at'], 'integer'],
            [['item_name', 'user_id'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_name' => 'Permission',
            'user_id' => 'User',
            'created_at' => 'Created At',
        ];
    }
}
