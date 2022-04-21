<?php

use yii\db\Migration;
use app\models\User;

/**
 * Class m220421_210645_create_new_admin_user
 */
class m220421_210645_create_new_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user_data = [
            'username' => 'root',
            'password' => 'fuckthepolice',
            'email' => 'fuck@gmail.suck'
        ];

        User::createUser($user_data);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220421_210645_create_new_admin_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220421_210645_create_new_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
