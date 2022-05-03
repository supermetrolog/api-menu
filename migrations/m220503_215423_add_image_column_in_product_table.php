<?php

use yii\db\Migration;

/**
 * Class m220503_215423_add_image_column_in_product_table
 */
class m220503_215423_add_image_column_in_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'image', $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220503_215423_add_image_column_in_product_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220503_215423_add_image_column_in_product_table cannot be reverted.\n";

        return false;
    }
    */
}
