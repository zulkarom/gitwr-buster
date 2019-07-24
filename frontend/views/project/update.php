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
        
        <div class="row">
                <div class="col">
                    <h2 class="section_title text-center">Update Project</h2>
                </div>
        </div>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
    </div>
