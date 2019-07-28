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
