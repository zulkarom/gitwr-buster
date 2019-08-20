<?php

use yii\helpers\Html;
use backend\modules\writerbooster\models\TemplateCat;

/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\Project */

$this->title = 'Choose Template';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box">
<div class="box-body">


<div class="project-update">

<div class="row">
<div class="col-md-6"><div class="form-group">
<label>Select Categories:</label>

<select class="form-control">
<option>Please Select...</option>
<?php 

$list = TemplateCat::find()->all();
foreach($list as $row){
	echo '<option>'.$row->cat_name .'</option>';
}

?>

</select>

</div></div>

<div class="col-md-6">
</div>

</div>


   

</div></div>
</div>

