<?php
return [
	'aliases' => [
		'@bower' => '@vendor/bower-asset',
		'@npm' => '@vendor/npm-asset',
	],	
	'components' => [
		'db' => [
			'class' => 'yii\db\Connection',
			'charset' => 'utf8',
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'image' => [
			'class' => 'yii\image\ImageDriver',
			'driver' => 'GD',  //GD or Imagick
		],
		'authManager' => [
			'class' => 'yii\rbac\DbManager',
			'defaultRoles' => ['registered'],
			'cache' => 'cache' //enable caching
		],
	],
	'modules' => [
	]

];
