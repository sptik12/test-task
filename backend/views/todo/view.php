<?php

use yii\helpers\Url;
use kartik\detail\DetailView;
use kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Todo */

$this->title = 'Id: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Todo Items'), 'url' => ['/todo']];
$this->params['breadcrumbs'][] = $this->title;

echo DetailView::widget([
	'model' => $model,
	'mode' => 'view',
//	'panel' => [
//		'type' => DetailView::TYPE_INFO,
//	],
	'deleteOptions' => ['url' => Url::toRoute(['delete', 'id' => $model->id])],
	'attributes' => [
		'title',
		[
			'attribute' => 'priority',
			'value' => $model->priority,
		],
		[
			'attribute' => 'done',
			'format' => 'raw',
			'value' => Html::tag('span', Yii::t('app', $model->done ? 'Yes' : 'No') , ['class' => 'badge bg-' . ($model->done ? 'success' :'danger')])
		],
	],
]);

