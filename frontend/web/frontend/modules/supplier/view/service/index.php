<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\supplier\models\SupplierProvideSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Supplier Provides';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-provide-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Supplier Provide', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'supplier_id',
            'service_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
