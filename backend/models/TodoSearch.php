<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TodoSearch represents the model behind the search form of `common\models\Todo`.
 */
class TodoSearch extends Todo
{
	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		$rules[] = [['id', 'title', 'priority', 'done'], 'safe'];
		return $rules;
	}

	/**
	 * {@inheritdoc}
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$query = Todo::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		// grid filtering conditions
		$query->andFilterWhere([
			'id' => $this->id,
			'priority' => $this->priority,
			'done' => $this->done,
		]);

		$query->andFilterWhere(['like', 'title', $this->title]);

		return $dataProvider;
	}
}
