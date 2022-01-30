<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
?>

<?= Html::tag('div', Yii::t('app', 'Conflict, item was changed by another user, your changes will be lost. {edit_again} {cancel}',
					['edit_again' => Html::a(Yii::t('app','[Edit again]'), $update_route),
					 'cancel' => Html::a(Yii::t('app','[Cancel]'),$cancel_route)]),
	['class' => 'alert alert-danger'])
?>
