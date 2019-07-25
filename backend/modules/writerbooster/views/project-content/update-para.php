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

<div class="box">
<div class="box-header"></div>
<div class="box-body"><div class="project-content-form">

<?php $form = ActiveForm::begin(); ?>

<div class="row">
<div class="col-md-6"><?= $form->field($model, 'ct_parent')->dropDownList($project->arrayHeadingPara) ?>

<?= $form->field($model, 'ct_text')->textInput() ?></div>

<div class="col-md-6">
<?= $form->field($model, 'ct_desc')->textarea(['rows' => '5']) ?>
</div>

</div>


<div class="row">
<div class="col-md-6"><div class="form-group">
	<?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> Save Paragraph', ['class' => 'btn btn-success']) ?>
</div></div>

<div class="col-md-6" align="right">
<?= Html::a('Delete', ['delete', 'project_id' => $project->id, 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this paragraph?',
                'method' => 'post',
            ],
        ]) ?>

</div>

</div>



<?php ActiveForm::end(); ?>

</div>
</div>
</div>


</div>
