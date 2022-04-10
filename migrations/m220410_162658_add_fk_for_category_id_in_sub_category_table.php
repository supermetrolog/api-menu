<?php

use yii\db\Migration;

/**
 * Class m220410_162658_add_fk_for_category_id_in_sub_category_table
 */
class m220410_162658_add_fk_for_category_id_in_sub_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-sub_category-category_id', 'sub_category', 'category_id', 'category', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220410_162658_add_fk_for_category_id_in_sub_category_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220410_162658_add_fk_for_category_id_in_sub_category_table cannot be reverted.\n";

        return false;
    }
    */
}
