<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\JqueryAsset;
use yii\jui\DatePicker;

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

    <?php foreach ($driversInOrder as $key => $driver) { ?>

        <?= $form->field($driver, 'driver_id')
             ->textInput()
             ->label('Водитель ' . ($key + 1))
             ->dropDownList(
                ArrayHelper::map(app\models\Drivers::find()->all(), 'id', 'name'), 
                            ['prompt'=>'пожалуйста, выберите водителя']) 
        ?>

        <?= $form->field($driver, 'distance')->textInput() ?>

    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
