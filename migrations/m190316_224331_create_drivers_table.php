<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%drivers}}`.
 */
class m190316_224331_create_drivers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('drivers_orders_driver_id', 'drivers_orders');
        $this->dropTable('drivers');
        $this->createTable('drivers', [
            'id' => $this->primaryKey(),
            'name' => $this->string(40)->notNull()->unique(),
            'experience' => $this->integer()->unsigned(),
            'rate' => $this->double(6, 2)->unsigned()->notNull(),
            'phonenumber' => $this->string(12)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('drivers');
    }
}
