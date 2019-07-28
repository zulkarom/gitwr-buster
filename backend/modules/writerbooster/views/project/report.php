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
<?= Html::a('Back Project List', ['/apps/project/index'], ['class' => 'btn btn-info']) ?> 

<br /><br />

<div class="box">
<div class="box-body">

<?=$this->render('_tab', [
       'model' => $model,
    ]);
?>



<div class="project-update">


<div class="row">
<div class="col-md-6"><h3>Total Session: <span id="parent-pomodoro"><?=$model->pomodoro?></span></h3>
<h3>Total Writing Duration: <span id="pomo_duration"><?=$model->projDuration?></span></h3></div>

<div class="col-md-6">
<h3>Total Heading: <span><?=$model->countHead()?></span></h3>
<h3>Total Paragraph: <span><?=$model->countPara()?></span></h3>
<h3>Total Comment: <span><?=$model->countComment()?></span></h3>
</div>

</div>

<div class="row">
<div class="col-md-6">
<div class="form-group"><?php 
	
	if($model->collaborations){
		echo '<table class="table table-stripped">';
		$i = 1;
		foreach($model->collaborations as $col){
			echo '<tr><td>'.$i.'. </td>
			<td>'.$col->user->fullname .'</td>
			
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




