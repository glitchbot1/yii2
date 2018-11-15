<?php

use yii\db\Migration;

/**
 * Handles the creation of table `profile`.
 */
class m181114_154040_create_profile_table extends Migration
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
            'phone'=>$this->bigInteger(),
            'description'=>$this->text(),
            'dateRegistration'=>$this->date(),
            'photo'=>$this->string(),
        ]);
        $this->addForeignKey('profile_user', 'profile', 'user_id', 'user', 'id', 'cascade', 'cascade');
        // связб между таблицами User и Profile ( имясвязи, таблицы которую связываем, поле для сявязи, таблица с которой будет связь, поле для звязи,
        // при удаление автоматически удаляется строка у сввязанной таблицы, при изменение первично ключа автоматичски изменяет первич кл у связаной таблиц)
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
