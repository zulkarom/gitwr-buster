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
<?= Html::a('Back Project Collaboration', ['/apps/project/collaboration'], ['class' => 'btn btn-info']) ?> 

<br /><br />

<div class="box">
<div class="box-body">

<?=$this->render('_tab-colla', [
       'model' => $model,
    ]);
?>



<div class="project-update">


<div class="row">
<div class="col-md-6"><h3>Total Session: <span id="parent-pomodoro"><?=$model->pomodoro?></span></h3>
<h3>Total Writing Duration: <span id="pomo_duration"><?=$model->projDuration?></span></h3></div>

<div class="col-md-6">
<h3>Total Heading: <span><?=$model->countHead()?></span></h3>
<h3>Total Paragraph: <span><?=$model->countPara()?></span></h3>
</div>

</div>







</div></div>

</div>




