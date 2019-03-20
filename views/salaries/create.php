<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Salaries */

$this->title = 'Create Salaries';
$this->params['breadcrumbs'][] = ['label' => 'Salaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salaries-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
