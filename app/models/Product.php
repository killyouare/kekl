<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int $category_id
 * @property string $image
 * @property string $name
 * @property float $price
 * @property string $country
 * @property int $year
 * @property string $model
 *
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id','name', 'price', 'country', 'year', 'model'], 'required'],
            [['category_id', 'year'], 'integer'],
            [['price'], 'number'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['image', 'name', 'country', 'model'], 'string', 'max' => 255],
            [['category_id'], 'unique'],
            [
                ['category_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Category::class,
                'targetAttribute' => ['category_id' => 'id']
            ],
        ];
    }

    public $imageFile;

    public function upload()
    {
        if ($this->validate()) {
            $this->image = 'uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($this->image);
            return true;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория ID',
            'image' => 'Изображение',
            'name' => 'Наименование',
            'price' => 'Цена',
            'country' => 'Страна производитель',
            'year' => 'Год выпуска',
            'model' => 'Модель',
            'imageFile' => 'Изображение',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}
