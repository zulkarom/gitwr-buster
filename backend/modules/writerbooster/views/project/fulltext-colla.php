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

<?=$this->render('_tab', [
       'model' => $model,
    ]);
?>



<div class="row">
<div class="col-md-12" class="confull">
<br />



<h2>Title: <?=$model->title?></h2>
<?=$model->description?>
<br />
<style>
a.close {
    display:none
}
.block-comment{
	background-color:#fffee6;
	padding:10px;
	border-radius: 10px;
	-webkit-box-shadow: 3px 3px 2px -2px rgba(0,0,0,0.75);
-moz-box-shadow: 3px 3px 2px -2px rgba(0,0,0,0.75);
box-shadow: 3px 3px 2px -2px rgba(0,0,0,0.75);
}
.block-comment-my{
	background-color:#cafbc4;
	padding:10px;
	border-radius: 10px;
	-webkit-box-shadow: 3px 3px 2px -2px rgba(0,0,0,0.75);
-moz-box-shadow: 3px 3px 2px -2px rgba(0,0,0,0.75);
box-shadow: 3px 3px 2px -2px rgba(0,0,0,0.75);
}
</style>

<?php 
if($model->fulltext){
	foreach($model->fulltext as $con){
		echo '<div class="form-group"><a href="'.Url::to(['/apps/project-content/' . $con->action, 'id' => $con->id ,'project_id' => $model->id]).'"><h3><b><span class="cancel">' . $con->numbering  . ' </span> ' . $con->text . '</b></h3></a></div>';
		if($con->children){
			foreach($con->children as $ch1){
				show_content($model->id, $ch1);
				if($ch1->children){
					foreach($ch1->children as $ch2){
						show_content($model->id, $ch2);
						if($ch2->children){
							foreach($ch2->children as $ch3){
								show_content($model->id, $ch3);
							}
						}
					}
				}
			}
		}
	}
	
}


function show_content($project, $para){
	echo '<div class="row">
	<div class="col-md-8"><div class="form-group" style="text-align:justify"><a href="'.Url::to(['/apps/project-content/'.$para->action , 'id' => $para->id ,'project_id' => $project]).'" style="color:#000"><h4><span class="cancel">' . $para->numbering . '</span> ' . $para->text . '</h4></a></div></div>
	<div class="col-md-4">
	<h3>
	<a href="'.Url::to(['/apps/project-content/update-para', 'id'=> $para->id, 'project_id' => $project]).'">
	<i class="fa fa-pencil"></i>
	</a>
	<i class="fa fa-commenting-o"></i></h3>
	';
	
	echo $para->comments;
	
	
	echo '</div>
	
	</div>';
}

?>


</div>

<div class="col-md-2" align="center">


</div>


</div></div>



</div>









<?php JSRegister::begin(['position' => static::POS_BEGIN]); ?>
<script>
	
function newPopup(url) {
	popupWindow = window.open(url,'popUpWindow','height=600,width=400,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}

</script>
<?php JSRegister::end(); ?>

