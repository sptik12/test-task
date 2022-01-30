<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;


class BaseActiveRecord extends ActiveRecord
{
	/**
	 * @var array
	 */
	public static $_cache = [];

	/**
	 * return now() from db
	 * @return string
	 */
	public static function getNowDb()
	{
		if (!array_key_exists('getNowDb', static::$_cache)) {
			static::$_cache['getNowDb'] = (new \yii\db\Query())->select('NOW() as cur_time')->scalar();
		}
		return static::$_cache['getNowDb'];
	}

	/**
	 * return curdate() from db
	 * @return string
	 */
	public static function getCurdateDb()
	{
		if (!array_key_exists('getCurdateDb', static::$_cache)) {
			static::$_cache['getCurdateDb'] = (new \yii\db\Query())->select('CURDATE() as cur_date')->scalar();
		}
		return static::$_cache['getCurdateDb'];
	}
	
	/**
	 * Save data to default fields
	 * @param bool $insert
	 * @return bool
	 * @throws \yii\base\InvalidConfigException
	 */
	public function beforeSave($insert)
	{
		if ($insert) {
			if ($this->hasAttribute('created_at')) {
				$this->created_at = new \yii\db\Expression('NOW()');
			}

			if ($this->hasAttribute('owner_id')) {
				if (empty($this->owner_id)) {
					$user = Yii::$app->get('user', false);
					$this->owner_id = $user && !$user->isGuest ? $user->id : null;
				}
			}
		}

		if ($this->hasAttribute('updated_at')) {
			$this->updated_at = new \yii\db\Expression('NOW()');
		}

		return parent::beforeSave($insert);
	}

	/**
	 * Set/get grid sort
	 * @param null $defaultValue
	 * @return array|null
	 */
	public function getSortDefaultOrder($defaultValue = null)
	{
		$getParam = 'sort';
		$key = get_class($this);
		$sessionParam = $getParam . $key;
		if (isset($_GET[$getParam])) {
			Yii::$app->session->set($sessionParam, $_GET[$getParam]);
		} else if (Yii::$app->session->get($sessionParam)) {
			$sortValue = Yii::$app->session->get($sessionParam);
			$sort = explode('-', $sortValue);
			return (count($sort) > 1) ? [$sort[1] => SORT_DESC] : [$sort[0] => SORT_ASC];
		}

		if ($defaultValue == null) {
			$sort = [];
			foreach ($this->tableSchema->primaryKey as $key) $sort[$key] = SORT_ASC;
			return $sort;
		} else
			return $defaultValue;
	}

}
