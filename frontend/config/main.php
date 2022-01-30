<?php
$params = array_merge(
	require __DIR__ . '/../../common/config/params.php',
	require __DIR__ . '/../../common/config/params-local.php',
	require __DIR__ . '/params.php',
	require __DIR__ . '/params-local.php'
);

return [
	'id' => 'app-frontend',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'controllerNamespace' => 'frontend\controllers',
	'components' => [
		'request' => [
			'enableCsrfValidation' => false,
			'parsers' => [
				'application/json' => 'yii\web\JsonParser',
			],
		],
		'response' => [
			'format' =>  \yii\web\Response::FORMAT_JSON,
			'on beforeSend' => function ($event) {
				$response = $event->sender;
				if ($response->data !== null) {
					$response->data = [
						'status' => $response->isSuccessful,
						'data' => $response->data,
					];
					$response->statusCode = 200;
				}
			},
		],
		'user' => [
			'identityClass' => 'common\models\User',
			'enableAutoLogin' => true,
			'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'enableStrictParsing' => false,
			'showScriptName' => false,
			'rules' => [
				[
					'class' => 'yii\rest\UrlRule',
					'pluralize' => false,
					'controller' => 'todo',
					'extraPatterns' => [
						'POST todo-done' => 'todo-done',
					]
				],
			],
		],
	],
	'params' => $params,
];
