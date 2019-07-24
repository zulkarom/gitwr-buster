<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\client\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Request', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'status',
            'client_id',
            'service_id',
            'client_specification:ntext',
            //'request_at',
            //'supplier_id',
            //'quotation_id',
            //'service_charge',
            //'client_accept_at',
            //'client_paid',
            //'customer_paid_at',
            //'progress',
            //'due_date',
            //'is_delivered',
            //'delivered_at',
            //'supplier_charge',
            //'supplier_charge_paid',
            //'supplier_paid_at',
            //'correction_allow',
            //'correction_number',
            //'has_maintenance',
            //'maintenance_period',
            //'maintenance_number',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
