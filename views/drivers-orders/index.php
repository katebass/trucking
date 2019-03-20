<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DriversOrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Дистанции, проеханные водителем в маршруте';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drivers-orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать запись о проеханной дистанции', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'order_id',
            [
                'attribute' => 'driver_id',
                'label' => 'Маршрут',
                'value' => function ($model) {
                    $driver = \app\models\Drivers::find()->where(['id' => $model->driver_id])->one();
                    return $driver['name'];
                },
            ],
            'driver_id',
            'distance',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
