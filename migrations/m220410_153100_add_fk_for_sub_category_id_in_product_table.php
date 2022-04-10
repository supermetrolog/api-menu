<?php

use yii\db\Migration;

/**
 * Class m220410_153100_add_fk_for_sub_category_id_in_product_table
 */
class m220410_153100_add_fk_for_sub_category_id_in_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-product_sub_category_id', 'product', 'sub_category_id', 'sub_category', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220410_153100_add_fk_for_sub_category_id_in_product_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220410_153100_add_fk_for_sub_category_id_in_product_table cannot be reverted.\n";

        return false;
    }
    */
}
