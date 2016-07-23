<?php

namespace c006\email\models;

use Yii;

/**
 * This is the model class for table "email_templates".
 *
 * @property integer $id
 * @property string $name
 * @property string $template_name
 * @property string $email_from
 * @property string $updated
 * @property string $html
 * @property integer $is_html
 *
 * @property EmailTemplateCss[] $emailTemplateCsses
 * @property EmailTemplateFiles[] $emailTemplateFiles
 * @property EmailTemplateFonts[] $emailTemplateFonts
 */
class EmailTemplates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_templates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'template_name', 'email_from', 'html'], 'required'],
            [['updated'], 'safe'],
            [['html'], 'string'],
            [['is_html'], 'integer'],
            [['name', 'template_name'], 'string', 'max' => 100],
            [['email_from'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'template_name' => Yii::t('app', 'Template Name'),
            'email_from' => Yii::t('app', 'Email From'),
            'updated' => Yii::t('app', 'Updated'),
            'html' => Yii::t('app', 'Html'),
            'is_html' => Yii::t('app', 'Is Html'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailTemplateCsses()
    {
        return $this->hasMany(EmailTemplateCss::className(), ['template_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailTemplateFiles()
    {
        return $this->hasMany(EmailTemplateFiles::className(), ['template_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailTemplateFonts()
    {
        return $this->hasMany(EmailTemplateFonts::className(), ['template_id' => 'id']);
    }
}
