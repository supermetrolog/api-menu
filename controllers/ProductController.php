<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use app\behaviors\BaseControllerBehaviors;
use app\models\Ingredient;
use app\models\Product;
use app\models\ProductSearch;
use Yii;

class ProductController extends ActiveController
{
    public $modelClass = 'app\models\Product';
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return BaseControllerBehaviors::getBaseBehaviors($behaviors, ['index', 'ingredients']);
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['delete']);
        unset($actions['create']);
        unset($actions['update']);
        return $actions;
    }

    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        return $searchModel->search(Yii::$app->request->queryParams);
    }
    public function actionCreate()
    {
        return Product::createProduct(Yii::$app->request->post());
    }
    public function actionUpdate($id)
    {
        return Product::updateProduct($this->findModel($id), Yii::$app->request->post());
    }
    public function actionIngredients()
    {
        return Ingredient::find()->all();
    }
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->delete()) {
            return ['message' => 'Вы удалили продукт ' . $model->title, 'data' => null];
        }
        return ['message' => 'Ошибка удаления продукта ' . $model->title, 'data' => null];
    }

    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
