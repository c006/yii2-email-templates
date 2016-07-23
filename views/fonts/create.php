<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model c006\email\models\Fonts */

$this->title = Yii::t('app', 'Create Fonts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fonts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fonts-create">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
