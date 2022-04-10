<?php

use yii\db\Migration;

/**
 * Class m220410_144836_add_product_table
 */
class m220410_144836_add_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->defaultValue(null),
            'sub_category_id' => $this->integer()->notNull(),
            'price' => $this->decimal(8, 2)->defaultValue(null),
            'price_old' => $this->decimal(8, 2)->defaultValue(null),
            'price_from' => $this->decimal(8, 2)->defaultValue(null),
            'price_to' => $this->decimal(8, 2)->defaultValue(null),
            'voluem' => $this->decimal(8, 2)->defaultValue(null),
            'voluem_from' => $this->decimal(8, 2)->defaultValue(null),
            'voluem_to' => $this->decimal(8, 2)->defaultValue(null),
            'voluem_type' => $this->tinyInteger()->defaultValue(null),
            'is_new' => $this->tinyInteger()->defaultValue(null),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);

        $this->createIndex('idx-product-sub_category_id', 'product', 'sub_category_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220410_144836_add_product_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220410_144836_add_product_table cannot be reverted.\n";

        return false;
    }
    */
}
