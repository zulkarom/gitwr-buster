<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\Project */

$this->title = 'Update Project';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box">
<div class="box-body">

<?=$this->render('_tab', [
       'model' => $model,
    ]);
?>
<br />

<div class="project-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div></div>
</div>

