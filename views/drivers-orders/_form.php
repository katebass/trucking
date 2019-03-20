<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\DriversOrders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="drivers-orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id')
			 ->textInput()
			 ->dropDownList(
		 		ArrayHelper::map(app\models\Orders::find()->all(), 'id', 'id'), 
		 					['prompt'=>'пожалуйста, выберите']) 
	?>

    <?= $form->field($model, 'driver_id')
			 ->textInput()
			 ->dropDownList(
		 		ArrayHelper::map(app\models\Drivers::find()->all(), 'id', 'name'), 
		 					['prompt'=>'пожалуйста, выберите']) 
	?>

    <?= $form->field($model, 'distance')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
