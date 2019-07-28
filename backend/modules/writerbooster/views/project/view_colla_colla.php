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

<br />



<div class="row">


<div class="col-md-8">






<br />
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



<br /><br /><br /><br />
</div>
</div>

</div>

</div>










