<?php

namespace c006\email\models;

use Yii;

/**
 * This is the model class for table "email_template_files".
 *
 * @property integer $id
 * @property integer $template_id
 * @property string $name
 * @property string $file
 *
 * @property EmailTemplates $template
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_template_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_id', 'name', 'file'], 'required'],
            [['template_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['file'], 'string', 'max' => 60],
            [['template_id'], 'exist', 'skipOnError' => TRUE, 'targetClass' => EmailTemplates::className(), 'targetAttribute' => ['template_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('app', 'ID'),
            'template_id' => Yii::t('app', 'Template'),
            'name'        => Yii::t('app', 'Name'),
            'file'        => Yii::t('app', 'File'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailTemplates()
    {
        return $this->hasOne(EmailTemplates::className(), ['id' => 'template_id']);
    }
}
