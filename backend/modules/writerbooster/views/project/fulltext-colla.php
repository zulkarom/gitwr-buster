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



<div class="row">
<div class="col-md-8" class="confull">
<br />



<h2>Title: <?=$model->title?></h2>
<?=$model->description?>
<br />


<?php 
if($model->fulltext){
	foreach($model->fulltext as $con){
		echo '<div class="form-group"><a href="'.Url::to(['/apps/project-content/' . $con->action, 'id' => $con->id ,'project_id' => $model->id]).'"><h3><b><span class="cancel">' . $con->numbering  . ' </span> ' . $con->text . '</b></h3></a></div>';
		if($con->children){
			foreach($con->children as $ch1){
				echo '<div class="form-group" style="text-align:justify;"><a href="'.Url::to(['/apps/project-content/' . $ch1->action, 'id' => $ch1->id ,'project_id' => $model->id]).'" style="color:#000"><h4><span class="cancel">' . $ch1->numbering . '</span> ' . $ch1->text . '</h4></a></div>';
				
				if($ch1->children){
					foreach($ch1->children as $ch2){
						echo '<div class="form-group" style="text-align:justify"><a href="'.Url::to(['/apps/project-content/' . $ch2->action, 'id' => $ch2->id ,'project_id' => $model->id]).'" style="color:#000"><h4><span class="cancel">' . $ch2->numbering . '</span> ' . $ch2->text . '</h4></a></div>';
						if($ch2->children){
							foreach($ch2->children as $ch3){
								echo '<div class="form-group" style="text-align:justify"><a href="'.Url::to(['/apps/project-content/'.$ch3->action , 'id' => $ch3->id ,'project_id' => $model->id]).'" style="color:#000"><h4><span class="cancel">' . $ch3->numbering . '</span> ' . $ch3->text . '</h4></a></div>';
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

