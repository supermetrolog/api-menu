<?php

use yii\db\Migration;

/**
 * Class m220410_170502_add_not_null_and_unique_index_for_url_title
 */
class m220410_170502_add_not_null_and_unique_index_for_url_title extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('category', 'url_title', $this->string()->notNull()->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220410_170502_add_not_null_and_unique_index_for_url_title cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220410_170502_add_not_null_and_unique_index_for_url_title cannot be reverted.\n";

        return false;
    }
    */
}
