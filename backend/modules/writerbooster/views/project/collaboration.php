<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\writerbooster\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Collaboration Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <div class="box">
<div class="box-header"></div>
<div class="box-body"><?= GridView::widget([
        'dataProvider' => $dataProvider,
		'options' => [ 'style' => 'table-layout:fixed;' ],
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			[
				'label' => 'Owner',
				'value' => function($model){
					return $model->user->fullname;
				}
			
			],
            [
				'attribute' => 'title',
				'contentOptions' => [ 'style' => 'width: 40%;' ],
			]
            ,
            //'description:ntext',
			
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
                'template' => '{writing} {setting}',
                //'visible' => false,
                'buttons'=>[
					'writing'=>function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span> View',['/apps/project/structure-colla/', 'id' => $model->id],['class'=>'btn btn-warning btn-sm']);
                    }
                ],
            
            ],
        ],
    ]); ?></div>
</div>

</div>
