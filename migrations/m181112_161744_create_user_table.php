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
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
            'password'=>$this->string(),
            'isAdmin'=>$this->boolean()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('user');
    }
}
