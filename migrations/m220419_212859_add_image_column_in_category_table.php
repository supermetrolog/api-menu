<?php

use yii\db\Migration;

/**
 * Class m220419_212859_add_image_column_in_category_table
 */
class m220419_212859_add_image_column_in_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('category', 'image', $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220419_212859_add_image_column_in_category_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220419_212859_add_image_column_in_category_table cannot be reverted.\n";

        return false;
    }
    */
}
