<?php 

use yii\helpers\Url;

$url = '/apps/project/';

$arr = [
	['Outline', $url . 'structure-colla'],
	['Full Text', $url . 'fulltext-colla'],
	['Collaboration', $url . 'view-colla-colla'],
	['Report', $url . 'report-colla'], 
];
?>
<ul class="nav nav-tabs">

	<?php 
	foreach($arr as $li){
		$class='';
		if($li[1] == $url . Yii::$app->controller->action->id){
			$class = ' class="active"';
		}
		echo '<li'.$class.'><a href="'.Url::to([$li[1], 'id' => $model->id]).'">'.$li[0].'</a></li>';
	}
	
	?>

</ul>