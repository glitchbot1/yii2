<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $date
 * @property int $price
 * @property int $category_id
 * @property bool $isActive
 * @property string $image
 * @property int $city_id
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['date'], 'safe'],
            [['price', 'category_id', 'city_id'], 'default', 'value' => null],
            [['price', 'category_id', 'city_id'], 'integer'],
            [['isActive'], 'boolean'],
            [['title', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'date' => 'Date',
            'price' => 'Price',
            'category_id' => 'Category ID',
            'isActive' => 'Is Active',
            'image' => 'Image',
            'city_id' => 'City ID',
        ];
    }
}
