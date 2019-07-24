<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\writerbooster\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <div class="box">
<div class="box-header"></div>
<div class="box-body"><?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'description:ntext',
			'pomodoro',
			'pomo_duration',
			[
				'attribute' => 'status',
				'format' => 'html',
				'value' => function($model){
					$text = $model->status == 1 ? 'COMPLETED' : 'IN PROGRESS';
					return '<span class="label label-success">'.$text.'</span>';
				}
				
			],
            ['class' => 'yii\grid\ActionColumn',
                 'contentOptions' => ['style' => 'width: 10%'],
                'template' => '{view}',
                //'visible' => false,
                'buttons'=>[
					'view'=>function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-search"></span> View',['/writerbooster/project/view-project/', 'id' => $model->id],['class'=>'btn btn-warning btn-sm']);
                    }
                ],
            
            ],
        ],
    ]); ?></div>
</div>

</div>
