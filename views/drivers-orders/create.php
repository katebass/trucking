<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DriversOrders */

$this->title = 'Create Drivers Orders';
$this->params['breadcrumbs'][] = ['label' => 'Drivers Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drivers-orders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
