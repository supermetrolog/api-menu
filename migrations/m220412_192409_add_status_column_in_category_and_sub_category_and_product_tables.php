<?php

use yii\db\Migration;

/**
 * Class m220412_192409_add_status_column_in_category_and_sub_category_and_product_tables
 */
class m220412_192409_add_status_column_in_category_and_sub_category_and_product_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('category', 'status', $this->tinyInteger()->notNull()->defaultValue(1));
        $this->addColumn('sub_category', 'status', $this->tinyInteger()->notNull()->defaultValue(1));
        $this->addColumn('product', 'status', $this->tinyInteger()->notNull()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220412_192409_add_status_column_in_category_and_sub_category_and_product_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220412_192409_add_status_column_in_category_and_sub_category_and_product_tables cannot be reverted.\n";

        return false;
    }
    */
}
