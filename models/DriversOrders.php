<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "drivers_orders".
 *
 * @property int $id
 * @property int $order_id
 * @property int $driver_id
 * @property string $distance
 *
 * @property Drivers $driver
 * @property Orders $order
 * @property Salaries[] $salaries
 */
class DriversOrders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'drivers_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'driver_id', 'distance'], 'required'],
            [['order_id', 'driver_id'], 'integer'],
            [['distance'], 'number'],
            [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Drivers::className(), 'targetAttribute' => ['driver_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Заказ',
            'driver_id' => 'Водитель',
            'distance' => 'Дистанция (км)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Drivers::className(), ['id' => 'driver_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalaries()
    {
        return $this->hasMany(Salaries::className(), ['drivers_orders_id' => 'id']);
    }
}
