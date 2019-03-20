<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "drivers".
 *
 * @property int $id
 * @property string $name
 * @property int $experience
 * @property string $rate
 * @property string $phonenumber
 *
 * @property DriversOrders[] $driversOrders
 */
class Drivers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'drivers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'rate'], 'required', 'message' => 'Это поле обязательно для заполнения'],
            [['experience'], 'integer'],
            [['rate'], 'number'],
            [['name'], 'string', 'max' => 40],
            [['phonenumber'], 'string', 'max' => 12],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО',
            'experience' => 'Опыт работы (лет)',
            'rate' => 'Ставка (грн.)',
            'phonenumber' => 'Номер телефона',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriversOrders()
    {
        return $this->hasMany(DriversOrders::className(), ['driver_id' => 'id']);
    }
}
