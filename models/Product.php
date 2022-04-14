<?php

namespace app\models;

use app\exceptions\ValidationErrorHttpException;
use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $sub_category_id
 * @property float|null $price
 * @property float|null $price_old
 * @property float|null $price_from
 * @property float|null $price_to
 * @property float|null $voluem
 * @property float|null $voluem_from
 * @property float|null $voluem_to
 * @property int|null $voluem_type
 * @property int|null $is_new
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property SubCategory $subCategory
 * @property ProductIngredient[] $productIngredients
 */
class Product extends \yii\db\ActiveRecord
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'sub_category_id'], 'required'],
            [['description'], 'string'],
            [['sub_category_id', 'voluem_type', 'is_new', 'status'], 'integer'],
            [['price', 'price_old', 'price_from', 'price_to', 'voluem', 'voluem_from', 'voluem_to'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['sub_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategory::className(), 'targetAttribute' => ['sub_category_id' => 'id']],
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
            'sub_category_id' => 'Sub Category ID',
            'price' => 'Price',
            'price_old' => 'Price Old',
            'price_from' => 'Price From',
            'price_to' => 'Price To',
            'voluem' => 'Voluem',
            'voluem_from' => 'Voluem From',
            'voluem_to' => 'Voluem To',
            'voluem_type' => 'Voluem Type',
            'is_new' => 'Is New',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    public function delete()
    {
        $this->status = self::STATUS_INACTIVE;
        return $this->save();
    }
    public function createIngredients($post_data)
    {
        if (!$post_data || !is_array($post_data)) {
            return true;
        }
        foreach ($post_data as $ingredient) {
            $model = new Ingredient();
            $model->title = $ingredient['title'];
            if (!$model->save()) {
                throw new ValidationErrorHttpException($model->getErrorSummary(false));
            }
        }
    }
    public function createProductIngredients($post_data, $product_id)
    {
        ProductIngredient::deleteAll(['product_id' => $product_id]);
        if (!$post_data || !is_array($post_data)) {
            return true;
        }
        foreach ($post_data as $ingredient) {
            $modelIngredient = Ingredient::find()->where(['title' => $ingredient['title']])->limit(1)->one();
            $modelProductIngredient = new ProductIngredient();
            $modelProductIngredient->product_id = $product_id;
            $modelProductIngredient->ingredient_id = $modelIngredient->id;
            if (!$modelProductIngredient->save()) {
                throw new ValidationErrorHttpException($modelProductIngredient->getErrorSummary(false));
            }
        }
    }
    public static function createProduct($post_data)
    {
        $transaction = Yii::$app->db->beginTransaction();
        $model = new static();
        try {
            if ($model->load($post_data, '') && $model->save()) {
                $model->createIngredients($post_data['ingredients']);
                $model->createProductIngredients($post_data['ingredients'], $model->id);
                $transaction->commit();
                return ['message' => 'Продукт создан', 'data' => $model->id];
            }

            throw new ValidationErrorHttpException($model->getErrorSummary(false));
        } catch (\Throwable $th) {
            $transaction->rollBack();
            throw $th;
        }
    }
    /**
     * Gets query for [[SubCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategory()
    {
        return $this->hasOne(SubCategory::className(), ['id' => 'sub_category_id']);
    }

    /**
     * Gets query for [[ProductIngredients]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductIngredients()
    {
        return $this->hasMany(ProductIngredient::className(), ['product_id' => 'id']);
    }

    public function getIngredients()
    {
        return $this->hasMany(Ingredient::className(), ['id' => 'ingredient_id'])->via('productIngredients');
    }
}
