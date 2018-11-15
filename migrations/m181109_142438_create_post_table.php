<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m181109_142438_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(),
            'description'=>$this->text(),
            'date'=>$this->date(),
            'price'=>$this->integer(),
            'category_id'=>$this->integer(),
            'city_id'=>$this->integer(),
            'isActive'=>$this->boolean()->defaultValue(true),
            'image'=>$this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('post');
    }
}
