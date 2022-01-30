<?php

namespace frontend\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

/**
 * Parent Rest API controller
 */
class ApiBaseController extends ActiveController
{
	/**
	 * {@inheritdoc}
	 */
	public function init()
	{
		return parent::init();
	}

	/*
	 *
	 */
	public function getParams()
	{
		$method = Yii::$app->getRequest()->getMethod();
		return $method == 'GET' ? Yii::$app->getRequest()->getQueryParams() : Yii::$app->getRequest()->getBodyParams();
	}

}
