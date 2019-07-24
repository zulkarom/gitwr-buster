<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\Project */

$this->title = 'Update Project';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="block-content">
        <div class="container">
		
		
		<ul class="nav nav-tabs">
<li class="nav-item">
    <a class="nav-link active" href="#"><i class="fa fa-clock-o"></i> TIMER</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">OUTLINE</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">MEMBERS</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">PROJECT REPORT</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">WRITING PAGE</a>
  </li>
</ul>


		
		<br />
<div class="row">
	<div class="col-md-6">
<div class="card">
  <div class="card-header">Categoris</div>
  <div class="card-body">Content</div> 
  <div class="card-footer"><a href=""><i class="fa fa-pencil"></i> Update Categories</a></div>

</div></div>
	<div class="col-md-6">
<div class="card">
  <div class="card-header">Members</div>
  <div class="card-body">Content</div> 
<div class="card-footer"><a href=""><i class="fa fa-pencil"></i> Update Members</a></div>
</div></div>
</div>




</div>
    </div>
