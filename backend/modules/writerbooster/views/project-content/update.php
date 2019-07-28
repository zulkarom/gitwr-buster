<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\ProjectContent */

$this->title = 'Update Content';
$this->params['breadcrumbs'][] = ['label' => 'Project Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-content-update">
<div class="form-group"><?=Html::a('Back to Structure', ['project/structure', 'id' => $project->id], ['class' => 'btn btn-default btn-sm'])?></div>
 <?= $this->render('_form', [
        'model' => $model,
		'project' => $project,
    ]) ?>


</div>
