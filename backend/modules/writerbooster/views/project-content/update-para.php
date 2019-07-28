<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\ProjectContent */

$this->title = 'Update Paragraph: ' . $model->ct_text;
$this->params['breadcrumbs'][] = ['label' => 'Project Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-content-update">
<div class="form-group"><?=Html::a('Back to Structure', ['project/structure', 'id' => $project->id], ['class' => 'btn btn-default btn-sm'])?></div>
 <?= $this->render('_form-para', [
        'model' => $model,
		'project' => $project,
		'para' => $para
    ]) ?>


</div>
