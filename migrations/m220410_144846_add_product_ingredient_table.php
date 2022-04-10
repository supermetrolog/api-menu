<?php

use yii\db\Migration;

/**
 * Class m220410_144846_add_product_ingredient_table
 */
class m220410_144846_add_product_ingredient_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product_ingredient', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'ingredient_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-product_ingredien-product_id', 'product_ingredient', 'product_id');
        $this->createIndex('idx-product_ingredien-ingredient_id', 'product_ingredient', 'ingredient_id');

        $this->addForeignKey('fk-product_ingredien-product_id', 'product_ingredient', 'product_id', 'product', 'id', 'CASCADE');
        $this->addForeignKey('fk-product_ingredien-ingredient_id', 'product_ingredient', 'ingredient_id', 'ingredient', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220410_144846_add_product_ingredient_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220410_144846_add_product_ingredient_table cannot be reverted.\n";

        return false;
    }
    */
}
