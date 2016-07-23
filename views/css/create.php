<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\email\models\Css */

$this->title = Yii::t('app', 'Create  Css');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', ' Css'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-template-css-create">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
