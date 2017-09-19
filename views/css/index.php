<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel c006\email\models\search\Css */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', ' Css');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Email Templates'), 'url' => ['/email']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-template-css-index">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create  Css'), ['create'], ['class' => 'btn btn-secondary']) ?>

        <?= Html::a(Yii::t('app', 'Online CSS Generators'), 'http://www.sitepoint.com/10-best-css3-code-generators/', ['class' => 'btn btn-secondary float-right', 'target' => '_blank']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'template_id',
                'value'     => 'emailTemplates.name'
            ],
            'selector',
            'css:ntext',
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '<div class="nowrap">{update} {delete}</div>'
            ],
        ],
    ]); ?>

</div>
