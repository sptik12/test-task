<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\OptimisticLockBehavior;

/**
 * This is the backend model class for table "todo".
 */
class Todo extends \common\models\Todo
{
	/*
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			OptimisticLockBehavior::className(),
		];
	}

	/*
	 * Return the name of version attribute
	 * @return string
	 */
	public function optimisticLock()
	{
		return 'version';
	}

	/**
	 * Get route
	 * @return array
	 */
	public function getRoute($params = [])
	{
		return ArrayHelper::merge(['/todo/view'], $params, ['id' => $this->id]);
	}

}
