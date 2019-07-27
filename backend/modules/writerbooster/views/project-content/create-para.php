<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\ProjectContent */

$this->title = 'Create New Paragraph';
$this->params['breadcrumbs'][] = ['label' => 'Project Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-content-create">

 <?= $this->render('_form-para', [
        'model' => $model,
		'project' => $project,
		'para' => $para
    ]) ?>

</div>
