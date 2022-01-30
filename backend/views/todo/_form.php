<?php
use yii\bootstrap5\ActiveForm;
use kartik\helpers\Html;
?>

<div class="panel-body">
<?php
$form = ActiveForm::begin(['id' => 'todo-form']);
?>

<?=$form->field($model, 'title')->textarea(['maxlength' => true,'rows' => 3, 'placeholder' => $model->getAttributeLabel('title')]) ?>
<?=$form->field($model, 'priority')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('priority')] ) ?>
<?=$form->field($model, 'done')->checkbox() ?>
<?=$form->field($model, 'version')->hiddenInput()->label(false) ?>

<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<?= Html::submitButton( Yii::t('app', 'Save'), ['class' =>'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'Cancel'), $route, ['class'=>'btn btn-default']) ?>
		<?php  if (!$model->isNewRecord) {
					echo Html::a(Yii::t('app', 'Delete'), ['/todo/delete', 'id' => $model->id], ['class'=>'btn btn-default','data-method' =>'post', 'data-confirm' => Yii::t('app', 'Are you sure to delete this Item?')]);
				}
		?>
	</div>
</div>
<?php ActiveForm::end(); ?>
</div>