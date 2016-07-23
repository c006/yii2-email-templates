<?php

use c006\activeForm\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\email\models\Files */
/* @var $form c006\activeForm\ActiveForm; */
?>

<div class="email-template-files-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?
    $model_link = \c006\email\models\EmailTemplates::find()->orderBy('name')->all();
    $model_link = ArrayHelper::map($model_link, 'id', 'name');
    echo $form->field($model, 'template_id')->dropDownList($model_link)->label('Template') ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => TRUE]) ?>

    <?= $form->field($model, 'file')->fileInput(['class' => 'form-control']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= c006\spinner\SubmitSpinner::widget(['form_id' => $form->id]); ?>


