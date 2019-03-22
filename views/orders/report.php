<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Расчетно-платежная ведомость';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-report">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'route_id',
                'label' => 'Маршрут',
                'value' => function ($model) {
                    $Route = \app\models\Routes::find()
                            ->where(['id' => $model->route_id])->one();
                    return $Route['route_name'];
                },
            ],
            'start_date',
            'end_date',
            [
                'label' => 'Дистанция (км.)',
                'value' => function ($model) {
                    $Route = \app\models\Routes::find()
                            ->where(['id' => $model->route_id])->one();
                    return $Route['distance'];
                },
            ],
            [
                'label' => 'Время в дороге (ч:м:с)',
                'value' => function ($model) {
                    $Route = \app\models\Routes::find()
                            ->where(['id' => $model->route_id])->one();
                    return $Route['time_estimate'];
                },
            ],
            [
                'label' => 'Цена заказа (грн.)',
                'value' => function ($model) {
                    $driversOrders = \app\models\DriversOrders::find()
                            ->where(['order_id' => $model->id])->all();
                    
                    $prices = [];
                    foreach ($driversOrders as $driver) {
                        array_push($prices, \app\models\Salaries::find()
                            ->where(['drivers_orders_id' => $driver['id']])->one()['salary']);
                    }
                    return array_sum($prices);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
