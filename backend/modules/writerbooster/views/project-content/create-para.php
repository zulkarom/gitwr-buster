<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\ProjectContent */

$this->title = 'Create New Paragraph';
$this->params['breadcrumbs'][] = ['label' => 'Project Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-content-create">

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
	<?= Html::submitButton('Next <span class="glyphicon glyphicon-arrow-right"></span>', ['class' => 'btn btn-success']) ?>
</div></div>



</div>



<?php ActiveForm::end(); ?>

</div>
</div>
</div>

</div>
