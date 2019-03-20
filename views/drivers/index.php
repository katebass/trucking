<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DriversSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Водители';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drivers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать запись о водителе', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'experience',
            'rate',
            'phonenumber',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
