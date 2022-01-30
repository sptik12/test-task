<?php

use yii\helpers\Url;
use backend\components\adminlte\widgets\Menu;

/** @var \yii\web\View $this */
?>

<aside class="main-sidebar sidebar-bg-dark sidebar-color-primary shadow">

	<div class="brand-container">
		<?= \yii\helpers\Html::a('<img class="brand-image opacity-80 shadow" src="/img/logo32x32.png" alt="Administrative Panel"><span class="brand-text fw-light">Administrative Panel</span>', Yii::$app->homeUrl, ['class' => 'brand-link']) ?>
	</div>

	<div class="sidebar">
		
		<?php
		Menu::$iconClassType = 'far fa';
		?>
		<nav class="mt-2">
			<?= Menu::widget(
				[
					'options' => ['class' => 'nav nav-pills nav-sidebar flex-column', 'data-lte-toggle' => 'treeview', "role" => "menu", "data-accordion" => "false"],
					'items' => [
						['label' => Yii::t('app', 'Todo'), 'icon' => 'pencil', 'url' => ['/todo/index'], 'active' => Yii::$app->controller->id == 'todo'],
						['label' => Yii::t('app', 'Other'), 'icon' => 'key', 'url' => '#'],
					],
				]
			) ?>
		</nav>

	</div>

</aside>
