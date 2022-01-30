<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

use common\models\Todo;

/**
 * TodoController implements the REST API for Todo model.
 */
class TodoController extends ApiBaseController
{
	/*
	 * {@inheritdoc}
	 */
	public $modelClass = "common\models\Todo";

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		$actions = parent::actions();
		unset($actions['delete'], $actions['create'], $actions['update'], $actions['view'], $actions['index']);
		return $actions;
	}

	/*
	 * REST API method
	 * POST /todo/todo-done
	 *
	 * Mark Todo item as done
	 *
	 * @param array ['id', 'done']
	 * @throws yii\web\BadRequestHttpException in case invalid param or db error
	 * @return common\models\Todo
	 * ['status' => 1|0, 'data' => $response->data];
	 */
	public function actionTodoDone()
	{
		$data = $this->params;
		$id = ArrayHelper::getValue($data, 'id');
		if (!is_null($id)) {
			$model = Todo::findOne($id);
			if ($model) {
				$done = ArrayHelper::getValue($data, 'done');
				if (!is_null($done)) {
					$model->done = $done;
					if ($model->save()) {
						return $model;
					}
					else {
						throw new BadRequestHttpException(implode($model->getFirstErrors()));
					}
				}
				else {
					throw new NotFoundHttpException(Yii::t('app', 'Invalid data'));
				}
			}
			else {
				throw new NotFoundHttpException(Yii::t('app', 'Invalid Id'));
			}
		}
		else {
			throw new BadRequestHttpException(Yii::t('app', 'Id is not defined'));
		}
	}
}
