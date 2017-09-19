<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model c006\email\models\Files */

$this->title = Yii::t('app', 'Upload  Files');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', ' Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-template-files-create">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
