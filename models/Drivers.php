<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "drivers".
 *
 * @property int $id
 * @property string $name
 * @property int $experience
 * @property double $rate
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
            [['name', 'rate', 'experience'], 'required', 'message' => 'Это поле обязательно для заполнения'],
            [['experience'], 'integer', 'max' => 70, 'min' => '1'],
            [['rate'], 'number', 'max' => 100, 'min' => 20],
            [['name'], 'string', 'max' => 40, 'min' => 2],
            [['phonenumber'], 'string', 'max' => 12, 'min' => 10],
            [['phonenumber'], 'match', 'not' => true, 'pattern' => '/[^0-9]/',
                    'message' => 'Номер телефона должен содержать только цифры'],
            [['name'], 'unique'],
            // [['name'], 'match', 'not' => true, 'pattern' => '/[^a-zA-Zа-яА-Я\s]/', 
            //             'message' => 'Имя не должно содержать символы или цифры']
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
