<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SalariesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Зарплаты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salaries-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //Html::a('Create Salaries', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'drivers_orders_id',
            // [
            //     'attribute' => 'drivers_orders_id',
            //     'label' => 'Маршрут',
            //     'value' => function ($model) {
            //         $driversOrders = \app\models\DriversOrders::find()
            //                     ->where(['id' => $model->drivers_orders_id])->one();
            //         //return $Route['route_name'];
            //     },
            // ],
            'salary',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
