<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "routes".
 *
 * @property int $id
 * @property string $route_name
 * @property string $distance
 * @property string $time_estimate
 *
 * @property Orders[] $orders
 */
class Routes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'routes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['route_name', 'distance', 'time_estimate'], 'required', 'message' => 'Это поле обязательно для заполнения'],
            [['distance', 'time_estimate'], 'number'],
            [['route_name'], 'string', 'max' => 191],
            [['route_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'route_name' => 'Название маршрута',
            'distance' => 'Дистанция (км)',
            'time_estimate' => 'Время в дороге (ч.)',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['route_id' => 'id']);
    }
}