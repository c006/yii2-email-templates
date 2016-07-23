<?php

use c006\activeForm\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\email\models\EmailTemplates */
/* @var $form c006\activeForm\ActiveForm; */
?>

<div class="email-templates-form">

    <?php $form = ActiveForm::begin([]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => TRUE]) ?>

    <?= $form->field($model, 'template_name')->textInput(['maxlength' => TRUE]) ?>

    <?= $form->field($model, 'email_from')->textInput(['maxlength' => TRUE]) ?>

    <?= $form->field($model, 'html')->textarea(['style' => 'width:100%; height:200px;']) ?>

    <?= $form->field($model, 'is_html')->dropDownList(['No','Yes'])->label('Send as HTML')->hint('No = "Plain text" / Yes = "HTML"') ?>

    <?= $form->field($model, 'updated')->hiddenInput()->label(FALSE) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= c006\spinner\SubmitSpinner::widget(['form_id' => $form->id]); ?>


<script type="text/javascript">
    jQuery(function () {
        jQuery('#emailtemplates-template_name')
            .bind('keyup', function () {
                var $this = jQuery(this);
                $this.val($this.val().toLowerCase().replace(' ', '-').replace(/[^0-9|a-z|\-|_]/g, ''));
            });
    });
</script>