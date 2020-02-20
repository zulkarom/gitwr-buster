<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use richardfan\widget\JSRegister;
/* @var $this yii\web\View */
/* @var $model backend\modules\writerbooster\models\ProjectContent */

?>
<div class="box">
<div class="box-body">

<?=$this->render('../project/_tab', [
       'model' => $project,
    ]);
?>
<br /><br />

<div class="project-content-form">

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
.block-comment{
	background-color:#fffee6;
	padding:10px;
	border-radius: 10px;
	-webkit-box-shadow: 3px 3px 2px -2px rgba(0,0,0,0.75);
-moz-box-shadow: 3px 3px 2px -2px rgba(0,0,0,0.75);
box-shadow: 3px 3px 2px -2px rgba(0,0,0,0.75);
}
.block-comment-my{
	background-color:#cafbc4;
	padding:10px;
	border-radius: 10px;
	-webkit-box-shadow: 3px 3px 2px -2px rgba(0,0,0,0.75);
-moz-box-shadow: 3px 3px 2px -2px rgba(0,0,0,0.75);
box-shadow: 3px 3px 2px -2px rgba(0,0,0,0.75);
}
</style>

<?php if($para->id){ ?>
<label>Comments</label>
<div id="con_comments"><?=$para->commentsHtml;?></div>

<div class="input-group">
    <input type="text" id="comment_text" class="form-control" style="height:50px;border-radius: 5px 0px 0px 5px;" placeholder="Write a comment to the paragraph.">
    <div class="input-group-btn">
      <button type="button" class="btn btn-info" id="send-comment" type="submit" style="height:50px">
        Comment
      </button>
    </div>
  </div>

<?php } ?>


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


<div>

<div align="right"><div class="form-group">
	<?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'project_id' => $project->id, 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this paragraph?',
                'method' => 'post',
            ],
        ]) ?>

</div></div>

</div>



<?php 

if($para->id){

JSRegister::begin(); ?>
<script>
$("#send-comment").click(function(){
	$("#comment_text").prop('disabled', true);
	$.ajax({
       url: '<?php echo Yii::$app->request->baseUrl. '/apps/project-content/comment' ?>',
       type: 'post',
       data: {
                 comment_text: $("#comment_text").val() , 
				 para: <?=$para->id?> ,
                 _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
             },
       success: function (data) {
		   $("#con_comments").html(data.hasil);
		   $("#comment_text").val('');
		   $("#comment_text").prop('disabled', false);
		   loadComment();
          //console.log(data);
       }
  });
});

loadComment();

function loadComment(){
	$(".close").click(function(){
		var str = $(this).attr('id');
		var arr = str.split('-');
		id = arr[1];
		deleteComment(id);
	});
}

function deleteComment(id){
	$.ajax({
       url: '<?php echo Yii::$app->request->baseUrl. '/apps/project-content/delete-comment' ?>',
       type: 'post',
       data: {
				 comment: id ,
				 para: <?=$para->id?>,
                 _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
             },
       success: function (data) {
		   $("#con_comments").html(data.hasil);
		   $("#comment_text").val('');
		   $("#comment_text").prop('disabled', false);
		   loadComment();
          //console.log(data);
       }
  });
}
</script>
<?php JSRegister::end(); 

}
?>

