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
            'user_id' => $this->primaryKey(),
            'name'=>$this->string(),
            'city_id'=>$this->integer(),
            'phone'=>$this->integer(),
            'description'=>$this->text(),
            'dateRegistration'=>$this->date(),
            'photo'=>$this->string()->defaultValue(null),
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
