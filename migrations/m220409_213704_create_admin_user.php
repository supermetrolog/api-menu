<?php

use yii\db\Migration;
use app\models\User;

/**
 * Class m220409_213704_create_admin_user
 */
class m220409_213704_create_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user_data = [
            'username' => 'admin',
            'password' => 'myata99512hh'
        ];

        User::createUser($user_data);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220409_213704_create_admin_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220409_213704_create_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
