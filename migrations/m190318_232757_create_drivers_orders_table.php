<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%drivers_orders}}`.
 */
class m190318_232757_create_drivers_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('salaries_drivers_orders_id', 'salaries');
        $this->dropTable('drivers_orders');
        $this->createTable('drivers_orders', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'driver_id' => $this->integer()->notNull(),
            'distance' => $this->decimal(5, 2)->unsigned()->notNull(),

        ]);

        $this->addForeignKey(
            'drivers_orders_order_id',
            'drivers_orders',
            'order_id',
            'orders',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'drivers_orders_driver_id',
            'drivers_orders',
            'driver_id',
            'drivers',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%drivers_orders}}');
    }
}
