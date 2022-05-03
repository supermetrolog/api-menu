<?php

namespace app\models;

use app\exceptions\ValidationErrorHttpException;
use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property SubCategory[] $subCategories
 */
class Category extends \yii\db\ActiveRecord
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            'image' => 'Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }
    public function uploadFiles($uploadFileModel, $model)
    {
        foreach ($uploadFileModel->files as $file) {
            if (!$uploadFileModel->uploadOne($file)) {
                throw new ValidationErrorHttpException($uploadFileModel->getErrorSummary(false));
            }
            $model->image = $uploadFileModel->filename;
        }
        return $model;
    }
    public static function createCategory($post_data, $fileManager)
    {
        $transaction = Yii::$app->db->beginTransaction();
        $model = new static();

        try {
            if ($model->load($post_data, '')) {
                $model = $model->uploadFiles($fileManager, $model);
                if ($model->save()) {
                    $transaction->commit();
                    return ['message' => 'Категория создана.', 'data' => true];
                }
            }
            throw new ValidationErrorHttpException($model->getErrorSummary(false));
        } catch (\Throwable $th) {
            $transaction->rollBack();
            throw $th;
        }
    }
    public static function updateCategory($model, $post_data, $fileManager)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($model->load($post_data, '')) {
                $model = $model->uploadFiles($fileManager, $model);
                if ($model->save()) {
                    $transaction->commit();
                    return ['message' => 'Категория изменена.', 'data' => true];
                }
            }
            // throw new ValidationErrorHttpException($model->getErrorSummary(false));
            throw new ValidationErrorHttpException($model->load($post_data, ''));
        } catch (\Throwable $th) {
            $transaction->rollBack();
            throw $th;
        }
    }
    public function delete()
    {
        $this->status = self::STATUS_INACTIVE;
        return $this->save();
    }
    /**
     * Gets query for [[SubCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategories()
    {
        return $this->hasMany(SubCategory::className(), ['category_id' => 'id'])->where(['status' => SubCategory::STATUS_ACTIVE]);
    }
}
