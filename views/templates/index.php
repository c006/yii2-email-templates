<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel c006\email\models\search\EmailTemplates */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Email Templates');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-templates-index">

    <h1 class="title-large"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Email Templates'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'template_name',
            'updated',
            [
                'attribute' => 'Sections',
                'format'    => 'raw',
                'value'     => function ($model) {
                    $html = '<div class="nowrap" >';
                    $html .= Html::a(Yii::t('app', 'Css'), ['/email/css/index', 'Css[template_id]' => $model->id, 'sort' => 'position'], ['class' => 'btn btn-success']);
                    $html .= ' ' . Html::a(Yii::t('app', 'Files'), ['/email/files/index', 'Files[template_id]' => $model->id, 'sort' => 'position'], ['class' => 'btn btn-success']);
                    $html .= ' ' . Html::a(Yii::t('app', 'Fonts'), ['/email/fonts/index', 'Fonts[template_id]' => $model->id, 'sort' => 'position'], ['class' => 'btn btn-success']);
                    $html .= '</div>';

                    return $html;
                }
            ],
            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => '<div class="nowrap">{update} {delete}</div>'
            ],
        ],
    ]); ?>

</div>
