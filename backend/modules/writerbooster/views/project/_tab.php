<?php 

use yii\helpers\Url;

$arr = [
	['Writing Zone','structure'],
	['Full Text', 'fulltext'],
	['Collaboration', 'view-colla'],
	['Report', 'report'], 
	['Setting', 'update']
];
?>
<ul class="nav nav-tabs">

	<?php 
	foreach($arr as $li){
		$class='';
		if($li[1] == Yii::$app->controller->action->id){
			$class = ' class="active"';
		}
		echo '<li'.$class.'><a href="'.Url::to([$li[1], 'id' => $model->id]).'">'.$li[0].'</a></li>';
	}
	
	?>

</ul>