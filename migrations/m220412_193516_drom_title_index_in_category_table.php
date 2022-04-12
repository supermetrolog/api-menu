<?php

use yii\db\Migration;

/**
 * Class m220412_193516_drom_title_index_in_category_table
 */
class m220412_193516_drom_title_index_in_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropIndex('title', 'category');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220412_193516_drom_title_index_in_category_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220412_193516_drom_title_index_in_category_table cannot be reverted.\n";

        return false;
    }
    */
}
