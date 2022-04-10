<?php

use yii\db\Migration;

/**
 * Class m220410_144719_add_sub_categories_table
 */
class m220410_144719_add_sub_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sub_category', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null)
        ]);

        $this->createIndex('idx-sub_category-category_id', 'sub_category', 'category_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220410_144719_add_sub_categories_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220410_144719_add_sub_categories_table cannot be reverted.\n";

        return false;
    }
    */
}
