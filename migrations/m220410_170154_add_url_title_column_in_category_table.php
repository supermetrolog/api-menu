<?php

use yii\db\Migration;

/**
 * Class m220410_170154_add_url_title_column_in_category_table
 */
class m220410_170154_add_url_title_column_in_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('category', 'url_title', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220410_170154_add_url_title_column_in_category_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220410_170154_add_url_title_column_in_category_table cannot be reverted.\n";

        return false;
    }
    */
}
