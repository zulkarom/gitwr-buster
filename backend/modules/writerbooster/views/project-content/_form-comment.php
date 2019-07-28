<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\ProjectContent */

?>
<?php $form = ActiveForm::begin(); ?>


<?= $form->field($comment, 'comment_text')->textInput()->label(false) ?>


<div class="form-group">
	<?= Html::submitButton('<span class="glyphicon glyphicon-plus"></span> Comment', ['class' => 'btn btn-info btn-sm']) ?>
</div>







<?php ActiveForm::end(); ?>


