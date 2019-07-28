<?php

use yii\helpers\Html;
use yii\helpers\Url;
use richardfan\widget\JSRegister;
use dosamigos\tinymce\TinyMce;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use common\models\User;



/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\Project */

$this->title = 'Project Update';

$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="form-group">
<?= Html::a('Back Project List', ['/apps/project/index'], ['class' => 'btn btn-info']) ?> 

<br /><br />

<div class="box">
<div class="box-body">

<?=$this->render('_tab', [
       'model' => $model,
    ]);
?>

<br />



<div class="row">


<div class="col-md-8">

<?php $form = ActiveForm::begin(); ?>

<?php

$url = Url::to(['/user/user-list-json']);
echo $form->field($colla, 'user_id')->widget(Select2::classname(), [
    'initValueText' =>'', // set the initial display text
    'options' => ['placeholder' => 'Search...'],
'pluginOptions' => [
    'allowClear' => true,
    'minimumInputLength' => 3,
    'language' => [
        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
    ],
    'ajax' => [
        'url' => $url,
        'dataType' => 'json',
        'data' => new JsExpression('function(params) { return {q:params.term}; }')
    ],
    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
    'templateResult' => new JsExpression('function(user) { return user.text; }'),
    'templateSelection' => new JsExpression('function (user) { return user.text; }'),
],
])->label(false);

 ?>


<?= Html::submitButton("<span class='glyphicon glyphicon-plus'></span> Add Collaboration", ['class' => 'btn btn-primary btn-sm']) ?>


    <?php ActiveForm::end(); ?>



<br />
<div class="form-group"><?php 
	
	if($model->collaborations){
		echo '<table class="table table-stripped">';
		$i = 1;
		foreach($model->collaborations as $col){
			echo '<tr><td>'.$i.'. </td>
			<td>'.$col->user->fullname .'</td>
			<td>';
			
			if($model->user_id != $col->user_id){
				echo Html::a('<span class="glyphicon glyphicon-remove"></span>', ['/apps/project/delete-colla', 'id' => $col->id], [
            'data' => [
                'confirm' => 'Are you sure you want to remove this user?',
                'method' => 'post',
            ],
        ]);
			}
			
			
			echo '</td>
			</tr>';
		$i++;
		}
		echo '</table>';
	}
	
	?></div>



<br /><br /><br /><br />
</div>
</div>

</div>

</div>










