<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "salaries".
 *
 * @property int $id
 * @property int $drivers_orders_id
 * @property string $salary
 *
 * @property DriversOrders $driversOrders
 */
class Salaries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'salaries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['drivers_orders_id'], 'required'],
            [['drivers_orders_id'], 'integer'],
            [['salary'], 'number'],
            [['drivers_orders_id'], 'exist', 'skipOnError' => true, 'targetClass' => DriversOrders::className(), 'targetAttribute' => ['drivers_orders_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'drivers_orders_id' => 'Номер заказа и водитель',
            'salary' => 'Зарплата',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriversOrders()
    {
        return $this->hasOne(DriversOrders::className(), ['id' => 'drivers_orders_id']);
    }
}
