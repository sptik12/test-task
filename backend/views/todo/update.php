<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Todo */

$this->title = Yii::t('app', 'Update Item Id: {id}', ['id' => $model->id]);

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Todo Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_form', [
	'model' => $model,
	'route' => $route,
]);