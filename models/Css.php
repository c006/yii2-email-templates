<?php

namespace c006\email\models;

use Yii;

/**
 * This is the model class for table "email_template_css".
 *
 * @property integer $id
 * @property integer $template_id
 * @property string $selector
 * @property string $css
 *
 * @property EmailTemplates $template
 */
class Css extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_template_css';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_id', 'selector', 'css'], 'required'],
            [['template_id'], 'integer'],
            [['css'], 'string'],
            [['selector'], 'string', 'max' => 45],
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
            'selector'    => Yii::t('app', 'Selector'),
            'css'         => Yii::t('app', 'Css'),
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
