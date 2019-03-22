<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $route_id
 * @property string $start_date
 * @property string $end_date
 *
 * @property DriversOrders[] $driversOrders
 * @property Routes $route
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['route_id', 'start_date', 'end_date'], 'required', 'message' => 'Это поле обязательно для заполнения'],
            [['route_id'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['route_id'], 'exist', 'skipOnError' => true, 'targetClass' => Routes::className(), 'targetAttribute' => ['route_id' => 'id']],
            // ['start_date', 'validateDates'],
            // ['start_date', 'date', 'timestampAttribute' => 'start_date'],
            // ['end_date', 'date','timestampAttribute' => 'end_date'],
            // ['end_date', 'compare', 'compareAttribute'=> 'start_date', 'operator' => '>=', 
            //     'message' => 'Пожалуйста, укажите корректные даты (конечная дата меньше или равна начальной'],

        ];  
    }

    // public function validateDates(){
    //     if(strtotime($this->end_date) < strtotime($this->start_date)){
    //         $this->addError('start_date','Пожалуйста, укажите корректные даты (конечная дата меньше или равна начальной)');
    //         $this->addError('end_date','Пожалуйста, укажите корректные даты (конечная дата меньше или равна начальной)');
    //     }
    // }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'route_id' => 'Маршрут',
            'start_date' => 'Начало маршрура',
            'end_date' => 'Окончание маршрута',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriversOrders()
    {
        return $this->hasMany(DriversOrders::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoute()
    {
        return $this->hasOne(Routes::className(), ['id' => 'route_id']);
    }
}
