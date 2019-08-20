<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\writerbooster\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">


    <p>
         <?= Html::a('Create Empty Project', ['create'], ['class' => 'btn btn-primary']) ?>
		 
		 <?= Html::a('Duplicate Project', ['create'], ['class' => 'btn btn-warning']) ?> 
		 
		 <?= Html::a('Template Guideline', ['template'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
<div class="box-header"></div>
<div class="box-body"><?= GridView::widget([
        'dataProvider' => $dataProvider,
		'options' => [ 'style' => 'table-layout:fixed;' ],
        //'filterModel' => $searchModel,
        'columns' => [
            [
			'class' => 'yii\grid\SerialColumn',
			'contentOptions' => [ 'style' => 'width: 5%;']
			],
			[
				'attribute' => 'title',
				'contentOptions' => [ 'style' => 'width: 65%;' ],
			]
            ,
            //'description:ntext',
			
			
			[
				'attribute' => 'status',
				'contentOptions' => [ 'style' => 'width: 10%;' ],
				'format' => 'html',
				'value' => function($model){
					$text = $model->status == 1 ? 'COMPLETED' : 'IN PROGRESS';
					return '<span class="label label-success">'.$text.'</span>';
				}
				
			],
            ['class' => 'yii\grid\ActionColumn',
                 //'contentOptions' => ['style' => 'width: 10%'],
                'template' => '{writing} {setting} {delete}',
                //'visible' => false,
                'buttons'=>[
					'writing'=>function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span> Writing',['/apps/project/structure/', 'id' => $model->id],['class'=>'btn btn-success btn-sm']);
                    },
					'report'=>function ($url, $model) {
                        return Html::a('<span class="fa fa-bar-chart"></span> Report',['/apps/project/report/', 'id' => $model->id],['class'=>'btn btn-info btn-sm']);
                    },
                    'setting'=>function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-cog"></span> Setting',['/apps/project/update/', 'id' => $model->id],['class'=>'btn btn-warning btn-sm']);
                    },
					'delete'=>function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',['/apps/project/delete', 'id' => $model->id],['class'=>'btn btn-danger btn-sm', 'data' => [
                'confirm' => 'Are you sure to delete this project?'
            ],
]);
                    }
                ],
            
            ],
        ],
    ]); ?></div>
</div>

</div>
