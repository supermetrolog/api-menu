<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%url_title_column_in_category}}`.
 */
class m220410_185043_drop_url_title_column_in_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('category', 'url_title');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return false;
    }
}
