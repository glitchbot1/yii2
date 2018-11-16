<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m181116_143236_create_post_table extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp()
  {
    $this->createTable('post', [
      'user_id' => $this->primaryKey(),
      'title'=>$this->string(),
      'description'=>$this->text(),
      'date'=>$this->date(),
      'price'=>$this->integer(),
      'category_id'=>$this->integer(),
      'city_id'=>$this->integer(),
      'isActive'=>$this->boolean()->defaultValue(true),
      'image'=>$this->string(),
    ]);
    $this->addForeignKey('post_user', 'post', 'user_id', 'user', 'id', 'cascade', 'cascade');
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropForeignKey('post_user', 'post');
    $this->dropTable('post');
  }
}

