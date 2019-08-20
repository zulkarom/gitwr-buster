<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box">
<div class="box-header"></div>
<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
	
</div></div>



<div class="box">
<div class="box-header">
<div class="box-title">Time Keeper Setting</div>
</div>
<div class="box-body">

	
	<div class="row">
<div class="col-md-6"><?= $form->field($model, 'status')->dropDownList( [0 => 'In Progress', 1 => 'Completed'] ) ?></div>

<div class="col-md-6">
<?php 
if($model->default_session == null){
	$model->default_session = 5;
}

echo $form->field($model, 'default_session')->textInput() 
?>
</div>

</div>
	
	
	
	<div class="row">
<div class="col-md-6"><?php 
if($model->pomo_duration == null){
	$model->pomo_duration = '00:30:00';
}

echo $form->field($model, 'pomo_duration')->textInput() 

?></div>

<div class="col-md-6"><?php 
if($model->pomo_long_break == null){
	$model->pomo_long_break = 3;
}

echo $form->field($model, 'pomo_long_break')->textInput() 
?>
</div>

</div>

<div class="row">
<div class="col-md-6"><?php 
if($model->short_break == null){
	$model->short_break = '00:05:00';
}

echo $form->field($model, 'short_break')->textInput();
?></div>

<div class="col-md-6"><?php 
if($model->long_break == null){
	$model->long_break = '00:15:00';
}

echo $form->field($model, 'long_break')->textInput() 
?>
</div>

</div>
	


    

    <?php ActiveForm::end(); ?>

</div>
</div>


	<div class="row">
<div class="col-md-6"><div class="form-group">
        <?= Html::submitButton('Save Project Setting', ['class' => 'btn btn-success']) ?>
    </div></div>



</div>
