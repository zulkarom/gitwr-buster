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


    <p>
         <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                'template' => '{writing} {setting} {delete}',
                //'visible' => false,
                'buttons'=>[
					'writing'=>function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span> Writing',['/writerbooster/project/write/', 'id' => $model->id],['class'=>'btn btn-success btn-sm']);
                    },
					'report'=>function ($url, $model) {
                        return Html::a('<span class="fa fa-bar-chart"></span> Report',['/writerbooster/project/report/', 'id' => $model->id],['class'=>'btn btn-info btn-sm']);
                    },
                    'setting'=>function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-cog"></span> Setting',['/writerbooster/project/update/', 'id' => $model->id],['class'=>'btn btn-warning btn-sm']);
                    },
					'delete'=>function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',['/website/event/delete-event/', 'id' => $model->id],['class'=>'btn btn-danger btn-sm', 'data' => [
                'confirm' => 'Are you sure to delete this event?'
            ],
]);
                    }
                ],
            
            ],
        ],
    ]); ?></div>
</div>

</div>