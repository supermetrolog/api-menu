<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ingredient".
 *
 * @property int $id
 * @property string $title
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property ProductIngredient[] $productIngredients
 */
class Ingredient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredient';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function save($withValidate = true, $defaultSave = false)
    {
        if ($defaultSave) {
            return parent::save($withValidate);
        }
        $isExistModel = self::find()->where(['title' => $this->title])->exists();

        if ($isExistModel) {
            return true;
        }
        return parent::save($withValidate);
    }
    /**
     * Gets query for [[ProductIngredients]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductIngredients()
    {
        return $this->hasMany(ProductIngredient::className(), ['ingredient_id' => 'id']);
    }
}
