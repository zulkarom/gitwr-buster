<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\ProjectContent */

?>
<div class="box">
<div class="box-header"></div>
<div class="box-body"><div class="project-content-form">

<?php $form = ActiveForm::begin(); ?>

<div class="row">
<div class="col-md-6"><?= $form->field($model, 'ct_parent')->dropDownList($project->arrayHeadingPara) ?>

<?= $form->field($model, 'ct_text')->textInput() ?></div>

<div class="col-md-6">
<?= $form->field($model, 'ct_desc')->textarea(['rows' => '5'])->label('Paragraph Assistance') ?>
</div>

</div>

<div class="row">
<div class="col-md-6">



<?= $form->field($para, 'para_text')->widget(TinyMce::className(), [
    'options' => ['rows' => 14],
    'language' => 'en',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap",
            "searchreplace visualblocks code fullscreen",
            "paste"
        ],
		'menubar' => false,
        'toolbar' => "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
    ]
]);?>


</div>

<div class="col-md-6">
<?= $form->field($para, 'para_desc')->textarea(['rows' => '3'])->label('Paragraph Note') ?>

<label>Comments</label>

<style>
a.close {
    text-decoration: none !important;
    font-size: 18px !important;
    line-height: 1.2;
}
.close {
    float: right;
    font-size: 21px;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    filter: alpha(opacity=20);
    opacity: .2;
}
</style>


<?php 

if($para->comments){
	echo '<table class="table table-stripped">';
	foreach($para->comments as $com){
		echo '<tr><td>
		<i style="font-size:12px"><strong>'.$com->user->fullname .'</strong> - '.$com->commentTime .'</i>
		
		
		<div style="background-color:#cafbc4;padding:10px;border-radius: 10px;">'.$com->comment_text .'<a href="#" class="close">&times;</a></div></td></tr>';
	}
	echo '</table>';
	
}else{
	echo 'No comment so far';
}


?>

<div class="input-group">
    <input type="text" class="form-control" style="height:50px;border-radius: 5px 0px 0px 5px;" placeholder="Write a comment to the paragraph.">
    <div class="input-group-btn">
      <button class="btn btn-info" type="submit" style="height:50px">
        Comment
      </button>
    </div>
  </div>




</div>

</div>







<div class="row">
<div class="col-md-6"><div class="form-group">
	<?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span>  Save Paragraph', ['class' => 'btn btn-success']) ?>
</div></div>





</div>



<?php ActiveForm::end(); ?>

</div>
</div>
</div>
