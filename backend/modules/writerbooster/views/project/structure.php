<?php

use yii\helpers\Html;
use yii\helpers\Url;
use richardfan\widget\JSRegister;
use dosamigos\tinymce\TinyMce;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use common\models\User;



/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\Project */

$this->title = 'Project Update';

$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="form-group"><?= Html::a('Back', ['/apps/project/index'], ['class' => 'btn btn-info']) ?> 

<a id="btn-start" href="JavaScript:newPopup('<?=Url::to(['/apps/project/counter', 'id' => $model->id])?>');" class="btn btn-warning" >START SESSION TIMER</a></div>


<div class="box">
<div class="box-header"></div>
<div class="box-body"><div class="project-update">


<div class="row">
<div class="col-md-6"><h3>Total Session: <span id="parent-pomodoro"><?=$model->pomodoro?></span></h3>
<h3>Total Writing Duration: <span id="pomo_duration"><?=$model->projDuration?></span></h3></div>

<div class="col-md-6">
<h3>Total Heading: <span><?=$model->countHead()?></span></h3>
<h3>Total Paragraph: <span><?=$model->countPara()?></span></h3>
</div>

</div>







</div></div>

</div>

<div class="row">
<div class="col-md-8"><div class="box">
<div class="box-header"><div class="box-title"><h4>CONTENT STRUCTURE</h4></div></div>
<div class="box-body">


<h2>Title: <?=$model->title?></h2>
<?=$model->description?>
<br /><br />
<div><a href="<?=Url::to(['/apps/project-content/create', 'project_id' => $model->id, 'type' => 1])?>" class="btn btn-success">Add Heading</a> <a href="<?=Url::to(['/apps/project-content/create-para', 'project_id' => $model->id])?>" class="btn btn-success">Add Paragraph</a></div>

<?php 
if($model->structure){
	foreach($model->structure as $con){
		echo '<div class="form-group"><a href="'.Url::to(['/apps/project-content/' . $con->action, 'id' => $con->id ,'project_id' => $model->id]).'"><h3><b><span class="cancel">' . $con->numbering  . ' </span> ' . $con->text . '</b></h3></a></div>';
		if($con->children){
			foreach($con->children as $ch1){
				echo '<div class="form-group" style="margin-left:'.$ch1->margin .'px"><a href="'.Url::to(['/apps/project-content/' . $ch1->action, 'id' => $ch1->id ,'project_id' => $model->id]).'"><h4><span class="cancel">' . $ch1->numbering . '</span> ' . $ch1->text . '</h4></a></div>';
				
				if($ch1->children){
					foreach($ch1->children as $ch2){
						echo '<div class="form-group" style="margin-left:'.$ch2->margin .'px"><a href="'.Url::to(['/apps/project-content/' . $ch2->action, 'id' => $ch2->id ,'project_id' => $model->id]).'"><h4><span class="cancel">' . $ch2->numbering . '</span> ' . $ch2->text . '</h4></a></div>';
						if($ch2->children){
							foreach($ch2->children as $ch3){
								echo '<div class="form-group" style="margin-left:'.$ch3->margin .'px"><a href="'.Url::to(['/apps/project-content/'.$ch3->action , 'id' => $ch3->id ,'project_id' => $model->id]).'"><h4><span class="cancel">' . $ch3->numbering . '</span> ' . $ch3->text . '</h4></a></div>';
							}
						}
					}
				}
			}
		}
	}
	
}

?>


</div>
</div></div>

<div class="col-md-4">
<div class="box">

<div class="box-header">

<div class="box-title"><h4>COLLABORATION</h4></div></div>

<div class="box-body">

<?php $form = ActiveForm::begin(); ?>

<?php

$url = Url::to(['/user/user-list-json']);
echo $form->field($colla, 'user_id')->widget(Select2::classname(), [
    'initValueText' =>'', // set the initial display text
    'options' => ['placeholder' => 'Search...'],
'pluginOptions' => [
    'allowClear' => true,
    'minimumInputLength' => 3,
    'language' => [
        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
    ],
    'ajax' => [
        'url' => $url,
        'dataType' => 'json',
        'data' => new JsExpression('function(params) { return {q:params.term}; }')
    ],
    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
    'templateResult' => new JsExpression('function(user) { return user.text; }'),
    'templateSelection' => new JsExpression('function (user) { return user.text; }'),
],
])->label(false);

 ?>



    <?php ActiveForm::end(); ?>

<div><a href="#" class="btn btn-success"><span class='glyphicon glyphicon-plus'></span> Add Collaboration</a></div>

<br />
<div class="form-group"><?php 
	
	if($model->collaborations){
		echo '<table class="table table-stripped">';
		$i = 1;
		foreach($model->collaborations as $col){
			echo '<tr><td>'.$i.'. </td>
			<td>'.$col->user->fullname .'</td>
			<td><span class="glyphicon glyphicon-remove"></span> </td>
			</tr>';
		$i++;
		}
		echo '</table>';
	}
	
	?></div>



<br /><br /><br /><br />
</div>
</div>

</div>

</div>









<?php JSRegister::begin(['position' => static::POS_BEGIN]); ?>
<script>
	
function newPopup(url) {
	popupWindow = window.open(url,'popUpWindow','height=600,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}

/* function setPomodoro(){
	var curr_pomo = parseInt($("#parent-pomodoro").text());
	curr_pomo++;
	$("#parent-pomodoro").text(curr_pomo);
	$("#project-pomodoro").val(curr_pomo);
	
	var pomo_duration = $("#pomo_duration").text();
	
	var new_duration = moment.utc(pomo_duration,'hh:mm:ss').add(10,'seconds').format('hh:mm:ss');
	
	$("#pomo_duration").text(new_duration);
	$("#project-pomo_duration").val(new_duration);
	
	
} */
</script>
<?php JSRegister::end(); ?>

