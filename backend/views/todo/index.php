<?php

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\helpers\Html;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TodoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Todo Items');
$this->params['breadcrumbs'][] = $this->title;

echo GridView::widget([
	'id' => 'email-grid',
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'itemLabelSingle' => Yii::t('app','Todo Item'),
	'itemLabelPlural' => Yii::t('app','Todo Items'),
	'panel' => [
		'heading' => Html::icon('key'),
	],
	'toolbar' => [
		['content' =>
			Html::a(Icon::show('plus'), ['create'], ['data-pjax' => 0, 'class' => 'btn btn-success', 'title' => Yii::t('app', 'Add New Item')])
		],
		'{toggleData}',
	],
	'columns' => [
		'id',
		[
			'attribute' => 'title',
			'content' => function ($data) {
				return Html::a(Html::encode($data->title), $data->getRoute(), ['data-pjax' => 0, 'title' => Yii::t('yii', 'View details')]);
			},
		],
		'priority',
		[
			'class'=>'kartik\grid\BooleanColumn',
			'attribute'=>'done',
		],
		['class' => 'kartik\grid\ActionColumn',
		'template' => '{update} {delete}',
		'buttons' => [
		],
		'contentOptions' => [
			'class' => 'action-column',
		],
		'deleteOptions' => [
			'data-pjax' => false,
		],
	],

	]
]);