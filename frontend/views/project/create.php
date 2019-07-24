<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\Project */

$this->title = 'Create Project';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-content">
		<div class="container">
		
		<div class="row">
				<div class="col">
					<h2 class="section_title text-center">CREATE PROJECT</h2>
				</div>
		</div>
		
			<div class="row">
			
			<div class="col-lg-12">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

			</div>
				
				
			
			</div>
			<br />

	
			
			
		</div>
	</div>