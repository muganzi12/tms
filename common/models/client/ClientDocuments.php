<?php

namespace common\models\client;

use Yii;
use common\models\client\Client;
/**
 * This is the model class for table "member_documents".
 *
 * @property int $id
 * @property int $member_id
 * @property int $document_type
 * @property int $name
 * @property string $description
 * @property string $file_name
 * @property int $client_id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class ClientDocuments extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'client_documents';
    }

    public $file;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['client_id', 'name', 'description', 'client_id', 'created_at', 'created_by'], 'required'],
            [['client_id', 'document_type', 'client_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['description', 'name'], 'string', 'max' => 255],
            [['file_name'], 'string', 'max' => 255],
            [['file_name'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf,png'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'client_id' => 'Client',
            'document_type' => 'Document Type',
            'name' => 'Name',
            'description' => 'Description',
            'file_name' => 'File Name',
            'client_id' => 'Client ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function getClient() {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
    }

}
