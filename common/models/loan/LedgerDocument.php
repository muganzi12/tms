<?php

namespace common\models\loan;

use Yii;

/**
 * This is the model class for table "ledger_document".
 *
 * @property int $id
 * @property string|null $issue_date
 * @property string|null $reference_no
 * @property string|null $description
 * @property string|null $comments_public Comments visible to everyone, including the applicant
 * @property string|null $comments_internal Comments only visible to the back office
 * @property int $document_type
 * @property string $file_attachment
 * @property string $file_extension
 * @property int|null $loan_id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class LedgerDocument extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ledger_document';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'document_type', 'file_attachment', 'file_extension', 'created_at', 'created_by'], 'required'],
            [['id', 'document_type', 'loan_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['issue_date'], 'safe'],
            [['description', 'comments_public', 'comments_internal', 'file_attachment'], 'string'],
            [['reference_no', 'file_extension'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'issue_date' => 'Issue Date',
            'reference_no' => 'Reference No',
            'description' => 'Description',
            'comments_public' => 'Comments Public',
            'comments_internal' => 'Comments Internal',
            'document_type' => 'Document Type',
            'file_attachment' => 'File Attachment',
            'file_extension' => 'File Extension',
            'loan_id' => 'Loan ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
