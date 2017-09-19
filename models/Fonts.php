<?php

namespace c006\email\models;

use Yii;

/**
 * This is the model class for table "fonts".
 *
 * @property integer $id
 * @property integer $template_id
 * @property string $name
 * @property string $font
 *
 * @property EmailTemplates $template
 */
class Fonts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_template_fonts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_id', 'name', 'font'], 'required'],
            [['template_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['font'], 'string', 'max' => 200],
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
            'font'        => Yii::t('app', 'Font'),
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
