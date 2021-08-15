<?php

namespace common\models\mail;

use Yii;

/**
 * This is the model class for table "email_inbox".
 *
 * @property int $id
 * @property string $sent_to
 * @property string $reference_no
 * @property string $sent_from
 * @property string $message
 * @property int $created_at
 * @property int $created_by
 * @property string $ip_address
 * @property string $sent_subject
 * @property int $successfully_sent
 */
class EmailInbox extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'email_inbox';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['sent_to', 'sent_from', 'message', 'created_at', 'created_by', 'ip_address', 'sent_subject', 'successfully_sent'], 'required'],
            [['message'], 'string'],
            [['created_at', 'created_by', 'successfully_sent'], 'integer'],
            [['sent_to', 'sent_from', 'sent_cc'], 'string', 'max' => 255],
            [['ip_address'], 'string', 'max' => 100],
            [['sent_subject'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'reference_no' => 'Reference Number',
            'sent_to' => 'Sent To',
            'sent_from' => 'From',
            'message' => 'Message',
            'created_at' => 'Date Sent',
            'created_by' => 'Sent By',
            'ip_address' => 'IP Address',
            'sent_subject' => 'Email Subject',
            'successfully_sent' => 'Successfully Sent',
        ];
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);
        $this->created_at = time();
        $this->created_by = Yii::$app->user->id;
        $this->ip_address = $_SERVER['REMOTE_ADDR'];
        return true;
    }

 
}
