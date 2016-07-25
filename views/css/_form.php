<?php

use c006\activeForm\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\email\models\Css */
/* @var $form c006\activeForm\ActiveForm; */
?>

<div class="email-template-css-form">

    <?php $form = ActiveForm::begin([]); ?>

    <?
    $model_link = \c006\email\models\EmailTemplates::find()->orderBy('name')->all();
    $model_link = ArrayHelper::map($model_link, 'id', 'name');
    echo $form->field($model, 'template_id')->dropDownList($model_link)->label('Template') ?>

    <?= $form->field($model, 'selector')->textInput(['maxlength' => TRUE])->hint('You will use this to call the css in the email. ') ?>

    <?= $form->field($model, 'css')->textarea(['style' => 'width:100%; height:200px;']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-secondary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= c006\spinner\SubmitSpinner::widget(['form_id' => $form->id]); ?>


