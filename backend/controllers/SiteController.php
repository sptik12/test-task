<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;

/**
 * Site controller
 */
class SiteController extends BaseController
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['error', 'index' ],
						'allow' => true,
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					// 'logout' => ['post'],
				],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

	/**
	 * @return string
	 */
	public function actionIndex()
	{
		return $this->render('index');
	}

}
