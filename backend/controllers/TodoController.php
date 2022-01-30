<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\helpers\Url;
use backend\models\Todo;
use backend\models\TodoSearch;

/**
 * TodoController implements the CRUD actions for Todo model.
 */
class TodoController extends BaseController
{
	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['index', 'view', 'update', 'create', 'delete'],
						'allow' => true,
					],
				],
			],
		];
	}

	/**
	 * Lists all Todo models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new TodoSearch();
		$dataProvider = $searchModel->search($this->queryParams);
		$dataProvider->pagination->pageSize = $this->gridPageSize;
		$dataProvider->sort->defaultOrder = $searchModel->getSortDefaultOrder(['priority' => SORT_DESC]);

		Url::remember(['index'], 'todo_form');

		$params = [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		];

		return Yii::$app->request->isAjax ? $this->renderPartial('index', $params) : $this->render('index', $params);
	}

	/**
	 * Displays a single Todo model.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id)
	{
		Url::remember(['view', 'id' => $id], 'todo_form');
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Todo model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Todo();

		$route = ($url = Url::previous('todo_form')) ? $url : ['index'];

		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->save(false)){
				return $this->redirect(['view', 'id' => $model->id]);
			}
		}
		else{
			$model->priority = 0;
			$model->done = 0;
		}

		return $this->render('create', [
			'model' => $model,
			'route' => $route
		]);
	}

	/**
	 * Updates an existing Todo model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		$route = ($url = Url::previous('todo_form')) ? $url : ['view', 'id' => $model->id];

		if ($model->load(Yii::$app->request->post())) {
			try {
				$model->save();
				return $this->redirect($route);
			}
			catch (yii\db\StaleObjectException $e) {
				return $this->render('/common/error',
					[
						'update_route' => Url::to(['/todo/update','id' => $model->id]),
						'cancel_route' => $route,
					]
				);
			}
		}
		return $this->render('update', [
				'model' => $model,
				'route' => $route,
		]);
	}

	/**
	 * Deletes an existing Todo model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete($id)
	{
		if ($model = $this->findModel($id)) {
			$model->delete();
		};

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Todo model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Todo the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Todo::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
