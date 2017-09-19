<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\email\models\Css */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => ' Css',
    ]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', ' Css'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="email-template-css-update">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
