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

<div class="form-group">
<?= Html::a('Back Project Collaboration', ['/apps/project/collaboration'], ['class' => 'btn btn-info']) ?> 

<br /><br />

<div class="box">
<div class="box-body">

<?=$this->render('_tab-colla', [
       'model' => $model,
    ]);
?>



<div class="project-update">
<h3>Overall Report</h3>

<div class="row">
<div class="col-md-6"><h4>Total Session: <span id="parent-pomodoro"><?=$model->countPomo()?></span></h4>
<h4>Total Writing Duration: <span id="pomo_duration"><?=$model->projDuration?></span></h4></div>

<div class="col-md-6">
<h4>Total Heading: <span><?=$model->countHead()?></span></h4>
<h4>Total Paragraph: <span><?=$model->countPara()?></span></h4>
<h4>Total Comment: <span><?=$model->countComment()?></span></h4>
</div>

</div>

<div class="row">
<div class="col-md-12">

<h3>Collaboration Report</h3>
<div class="form-group"><?php 
	
	if($model->collaborations){
		echo '<table class="table table-stripped">
		<thead>
		<tr>
			<th>No.</th><th>Name</th><th>Contents</th><th>Comments</th><th>Session</th>
			<th>Duration</th>
		</tr>
		</thead>
		
		';
		$i = 1;
		foreach($model->collaborations as $col){
			echo '<tr><td>'.$i.'. </td>
			<td>'.$col->user->fullname .'</td>
			<td>'.$model->countContentByUser($col->user_id).'</td>
			<td>'.$model->countCommentByUser($col->user_id).'</td>
			<td>'.$model->countPomoByUser($col->user_id).'</td>
			<td>'.$model->projDurationByUser($col->user_id).'</td>
			</tr>';
		$i++;
		}
		echo '</table>';
	}
	
	?></div>

</div>

<div class="col-md-6">
</div>

</div>





</div></div>

</div>




