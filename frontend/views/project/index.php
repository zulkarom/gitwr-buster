<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\writerbooster\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>


    
<div class="block-content">
        <div class="container">
        
        <div class="row">
                <div class="col">
                    <h2 class="section_title text-center">MY PROJECT</h2>
                </div>
        </div>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
			'contentOptions' => [ 'style' => 'width: 5%;' ],
			],
            'title',

            ['class' => 'yii\grid\ActionColumn',
                 'contentOptions' => ['style' => 'width: 32%'],
                'template' => '{update} {edit}',
                //'visible' => false,
                'buttons'=>[
					'edit'=>function ($url, $model) {
                        return Html::a('<span class="fa fa-cog"></span> EDIT SETTING',['project/update/', 'id' => $model->id],['class'=>'btn btn-warning btn-sm']);
                    },
                    'update'=>function ($url, $model) {
                        return Html::a('<span class="fa fa-pencil"></span> UPDATE PROJECT',['project/update-project/', 'id' => $model->id],['class'=>'btn btn-primary btn-sm']);
                    }
                ],
            
            ],

        ],
    ]); ?>


</div>
    </div>

