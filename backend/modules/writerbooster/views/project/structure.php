<?php

use yii\helpers\Html;
use yii\helpers\Url;
use richardfan\widget\JSRegister;
use dosamigos\tinymce\TinyMce;
use kartik\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\Project */

$this->title = 'Write';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box">
<div class="box-header"></div>
<div class="box-body"><div class="project-update" align="center">
<?= Html::a('Back', ['/apps/project/index'], ['class' => 'btn btn-info']) ?> 
<a id="btn-start" href="JavaScript:newPopup('<?=Url::to(['/apps/project/counter', 'id' => $model->id])?>');" class="btn btn-warning" >START POMODORO TIMER</a>

<h3>Total Pomodoro for the project: <span id="parent-pomodoro"><?=$model->pomodoro?></span></h3>
<h3>Total Writing Duration for the project: <span id="pomo_duration"><?=$model->pomo_duration?></span></h3>

 <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
 <?=$form->field($model, 'pomo_duration')->hiddenInput()->label(false)?>
 <?=$form->field($model, 'pomodoro')->hiddenInput()->label(false)?>
 


    <?php ActiveForm::end(); ?>

</div></div>

</div>



<?php JSRegister::begin(['position' => static::POS_BEGIN]); ?>
<script>
	
function newPopup(url) {
	popupWindow = window.open(url,'popUpWindow','height=600,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}

function setPomodoro(){
	var curr_pomo = parseInt($("#parent-pomodoro").text());
	curr_pomo++;
	$("#parent-pomodoro").text(curr_pomo);
	$("#project-pomodoro").val(curr_pomo);
	
	var pomo_duration = $("#pomo_duration").text();
	
	var new_duration = moment.utc(pomo_duration,'hh:mm:ss').add(10,'seconds').format('hh:mm:ss');
	
	$("#pomo_duration").text(new_duration);
	$("#project-pomo_duration").val(new_duration);
	
	
}
</script>
<?php JSRegister::end(); ?>

