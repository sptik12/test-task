<?php
return [
	'components' => [
		'db' => [
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=' . getenv('MYSQL_HOST') .';dbname=' . getenv('MYSQL_DATABASE'),
			'username' => getenv('MYSQL_USER'),
			'password' => getenv('MYSQL_PASSWORD'),
			'charset' => 'utf8',
		],
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			'viewPath' => '@common/mail',
			'useFileTransport' => false,
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => getenv('MAILHOG_HOST', true) ?: 'mailhog', // Docker container
				'port' => 1025
			],
		],
	],
];
