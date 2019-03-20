<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m190317_213854_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('drivers_orders_order_id', 'drivers_orders');
        $this->dropTable('orders');

        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'route_id' => $this->integer()->notNull(),
            'start_date' => $this->date()->notNull(),
            'end_date' => $this->date()->notNull(),
        ]);

        $this->addForeignKey(
            'routes_fk',
            'orders',
            'route_id',
            'routes',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // $this->addForeignKey(
        //     'first_driver_fk',
        //     'orders',
        //     'first_driver_id',
        //     'drivers',
        //     'id',
        //     'CASCADE',
        //     'CASCADE'
        // );

        // $this->addForeignKey(
        //     'second_driver_fk',
        //     'orders',
        //     'second_driver_id',
        //     'drivers',
        //     'id',
        //     'CASCADE',
        //     'CASCADE'
        // );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('orders');
    }
}
