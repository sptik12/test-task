<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Todo]].
 *
 * @see Todo
 */
class TodoQuery extends \yii\db\ActiveQuery
{
	/**
	 * {@inheritdoc}
	 * @return Todo[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return Todo|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
