<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\ProjectContent */

?>
<div class="box">
<div class="box-header"></div>
<div class="box-body"><div class="project-content-form">

<?php $form = ActiveForm::begin(); ?>


<div class="row">
<div class="col-md-6">
<?= $form->field($model, 'ct_parent')->dropDownList($project->arrayHeading) ?>

<?= $form->field($model, 'ct_text')->textInput()->label('Heading Text') ?></div>

<div class="col-md-6">
<?= $form->field($model, 'ct_desc')->textarea(['rows' => 5]) ?>
</div>

</div>



<div class="form-group">
	<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
</div>
</div>
