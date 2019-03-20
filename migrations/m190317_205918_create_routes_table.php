<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%routes}}`.
 */
class m190317_205918_create_routes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('routes_fk', 'orders');
        $this->dropTable('routes');
        $this->createTable('routes', [
            'id' => $this->primaryKey(),
            'route_name' => $this->string(191)->notNull()->unique(),
            'distance' => $this->decimal(5, 2)->notNull(),
            'time_estimate' => $this->decimal(5, 2)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('routes');
    }
}
