<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\OptimisticLockBehavior;

/**
 * This is the model class for table "todo".
 *
 * @property int $id
 * @property string $title
 * @property int $priority
 * @property boolean $done
 * @property int $version
 */
class Todo extends BaseActiveRecord
{
	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'todo';
	}

	/**
	 * {@inheritdoc}
	 * @return TodoQuery the active query used by this AR class.
	 */
	public static function find()
	{
		return new TodoQuery(get_called_class());
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['title', 'priority'], 'required'],
			[['priority', 'version'], 'integer'],
			[['done'], 'boolean'],
			[['version'], 'safe']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'Id'),
			'title' => Yii::t('app', 'Title'),
			'priority' => Yii::t('app', 'Priority'),
			'done' => Yii::t('app', 'Done'),
			'version' => Yii::t('app', 'Version'),
		];
	}

}
