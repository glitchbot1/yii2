<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m181112_161744_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('profile', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
            'password'=>$this->string(),
            'isAdmin'=>$this->boolean()->defaultValue(0),
        ]);
        $this->addForeignKey('profile_user', 'profile', 'user_id', 'user', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('profile_user', 'profile');
        $this->dropTable('profile');
    }
}
