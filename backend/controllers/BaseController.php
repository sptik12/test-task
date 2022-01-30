<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

/**
 * Parent controller
 */
class BaseController extends Controller
{
	/**
	 * Get Query Params and merge with state
	 * @param string $key
	 */
	public function getQueryParams($key = '', $param = 'page', $clear = 'clear')
	{
		$session_key = $this->id . '_' . $this->action->id . '_filter_' . $key;
		$query_params = Yii::$app->request->queryParams;
		if (isset($query_params[$clear])) {
			Yii::$app->session->set($session_key, []);
			unset($_GET[$clear]);
		}
		$session_params = Yii::$app->session->get($session_key);
		if (is_array($session_params)) {
			if (isset($session_params[$param]) && !isset($query_params[$param])) {
				$_GET[$param] = $session_params[$param];
			}
			$query_params = ArrayHelper::merge($session_params, $query_params);
		}
		Yii::$app->session->set($session_key, $query_params);
		return $query_params;
	}

	/**
	 * Get Grid size
	 *
	 * @param int $default
	 * @return int
	 */
	public function getGridPageSize($default = 10)
	{
		if (isset(Yii::$app->params['gridPageSize'])) {
			return (int)Yii::$app->params['gridPageSize'];
		} else {
			return $default;
		}
	}
}
