<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\ProjectContent */

$this->title = 'Create New Heading';
$this->params['breadcrumbs'][] = ['label' => 'Project Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-content-create">

    <?= $this->render('_form', [
        'model' => $model,
		'project' => $project,
    ]) ?>

</div>
