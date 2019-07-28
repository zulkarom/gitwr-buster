<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\ProjectContent */

?>
<div class="project-content-form">

<?php $form = ActiveForm::begin(); ?>


<div class="row">
<div class="col-md-6">
<?= $form->field($model, 'ct_parent')->dropDownList($project->arrayHeading) ?>

<?= $form->field($model, 'ct_text')->textInput()->label('Heading Text') ?></div>

<div class="col-md-6">
<?= $form->field($model, 'ct_desc')->textarea(['rows' => 5]) ?>
</div>

</div>

<div class="row">
<div class="col-md-6"><div class="form-group">
	<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div></div>

<div class="col-md-6" align="right"><div class="form-group">
	<?= Html::a('Delete', ['delete', 'project_id' => $project->id, 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this paragraph?',
                'method' => 'post',
            ],
        ]) ?>

</div></div>

</div>





<?php ActiveForm::end(); ?>

</div>

