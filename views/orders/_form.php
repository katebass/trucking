<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\JqueryAsset;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(
    '@web/js/orders.js', [
    'depends' => [ JqueryAsset::className() ]]);

?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'route_id')
    		 ->dropDownList(
    		 	ArrayHelper::map(app\models\Routes::find()->all(), 'id', 'route_name'), 
    		 				['prompt'=>'пожалуйста, выберите']) 
	?>

    <div id="route-distance-placeholder">
        <?php 
            $distance = app\models\Routes::find()->where(['id' => $model->route_id])->one()->distance;
            echo ($distance > 0 ? $distance : 0) . ' км.';
        ?>
    </div>

    <?= $form->field($model, 'start_date')->widget(\yii\jui\DatePicker::class, 
        ['dateFormat' => 'yyyy-MM-dd',]) ?>

    <?= $form->field($model, 'end_date')->widget(\yii\jui\DatePicker::class,
        ['dateFormat' => 'yyyy-MM-dd',]) ?>


    <?php
        echo $form->field($driversInOrder, 'drivers')->widget(MultipleInput::className(), [
            'max' => 2,
            //'min'               => 1, // should be at least 2 rows
            //'allowEmptyList'    => false,
            //'enableGuessTitle'  => true,
            //'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
            'columns' => [
                [
                    'name'  => 'driver_id',
                    'type'  => 'dropDownList',
                    'title' => 'Водители',
                    'options' => ['label' => false],
                    'items' => [
                        'prompt' => 'пожалуйста, выберите водителя',
                        ArrayHelper::map(app\models\Drivers::find()->all(), 'id', 'name')
                    ]
                ],
                [
                    'name'  => 'distance',
                    'title' => 'Дистанция водителя',
                    //'enableError' => true,
                    'options' => [
                    'class' => 'input-priority'
                    ]
                ]
            ]
        ])
        ->label(false);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
