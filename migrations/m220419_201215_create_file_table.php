<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%file}}`.
 */
class m220419_201215_create_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%file}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->defaultValue(null),
            'sub_category_id' => $this->integer()->defaultValue(null),
            'product_id' => $this->integer()->defaultValue(null),
            'name' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'filename' => $this->string()->notNull(),
            'size' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ]);

        $this->createIndex('idx-file-category_id', 'file', 'category_id');
        $this->createIndex('idx-file-sub_category_id', 'file', 'sub_category_id');
        $this->createIndex('idx-file-product_id', 'file', 'product_id');

        $this->addForeignKey('fk-file-category_id', 'file', 'category_id', 'category', 'id', 'CASCADE');
        $this->addForeignKey('fk-file-sub_category_id', 'file', 'sub_category_id', 'sub_category', 'id', 'CASCADE');
        $this->addForeignKey('fk-file-product_id', 'file', 'product_id', 'product', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%file}}');
    }
}
