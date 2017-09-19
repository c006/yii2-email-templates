<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel c006\email\models\search\Files */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', ' Files');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Email Templates'), 'url' => ['/email']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-template-files-index">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create  Files'), ['create'], ['class' => 'btn btn-secondary']) ?>
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
            [
                'attribute' => 'Code',
                'format'    => 'raw',
                'value'     => function ($model) {
                    return '<div>{IMG_' . $model->id . '}</div>';
                },
            ],
            'name',
            'file',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="nowrap">{update} {delete}</div>'
            ],
        ],
    ]); ?>

</div>
