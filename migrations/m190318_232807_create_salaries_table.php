<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%salaries}}`.
 */
class m190318_232807_create_salaries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('salaries');
        $this->createTable('salaries', [
            'id' => $this->primaryKey(),
            'drivers_orders_id' => $this->integer()->notNull(),
            'salary' => $this->double(5, 2)->unsigned()
        ]);

        $this->addForeignKey(
            'salaries_drivers_orders_id',
            'salaries',
            'drivers_orders_id',
            'drivers_orders',
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
        $this->dropTable('{{%salaries}}');
    }
}
