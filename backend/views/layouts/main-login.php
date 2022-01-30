<?php

use yii\helpers\Html;
use backend\components\adminlte\widgets\Alert;

/** @var \yii\web\View $this */
/** @var string $content */

backend\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
	<meta charset="<?= Yii::$app->charset ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>

<body class="login-page">
<?php $this->beginBody() ?>
	<?= Alert::widget(); ?>
	<?= $content ?>
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
