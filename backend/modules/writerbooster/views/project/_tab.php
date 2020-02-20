<?php 

use yii\helpers\Url;

$url = '/apps/project/';
$arr = [
	['Outline', $url . 'structure'],
	['Full Text',  $url . 'fulltext'],
	['Collaboration',  $url . 'view-colla'],
	['Report',  $url . 'report'], 
	['Setting',  $url . 'update']
];
?>
<ul class="nav nav-tabs">

	<?php 
	foreach($arr as $li){
		$class='';
		$action = Yii::$app->controller->action->id;
		if($li[1] ==  $url .  $action){
			$class = ' class="active"';
		}
		echo '<li'.$class.'><a href="'.Url::to([$li[1], 'id' => $model->id]).'">'.$li[0].'</a></li>';
	}
	
	?>

</ul>