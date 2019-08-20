<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\modules\writerbooster\models\TemplateCat;
use richardfan\widget\JSRegister;

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

<select class="form-control" id="choose-template">
<option>Please Select...</option>
<?php 

$list = TemplateCat::find()->orderBy('cat_order ASC')->all();
foreach($list as $row){
	$sel = $cat == $row->id ? 'selected' : '';
	echo '<option value="'.$row->id .'" '.$sel.'>'.$row->cat_name .'</option>';
}

?>

</select>

</div></div>

</div>

</div></div>
</div>

<?php if ($list){?>
<div class="box">
<div class="box-header"></div>
<div class="box-body">
<div class="table-responsive">
  <table class="table table-striped table-hover">
    <tbody>
	
	<?php 
	$i = 1;
	foreach($items as $item){
		echo '<tr>
		<td width="2%">'.$i .'. </td>
        <td>'.$item->category->cat_name .': '.$item->tem_name .'</td>
        <td><a href="'.Url::to(['process-template', 'id' => $item->id]).'" class="btn btn-primary">Create</a></td>
      </tr>';
	  $i++;
	}
	
	
	?>
      

    </tbody>
  </table>
</div>


</div>
</div>
<?php } ?>





<?php JSRegister::begin(); ?>
<script>
$("#choose-template").change(function(){
	var val = $(this).val();
	window.location.href = '<?=Url::to(['/apps/project/template', 'id' => ''])?>' + val;
});



</script>
<?php JSRegister::end(); ?>

