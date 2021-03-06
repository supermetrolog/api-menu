<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use app\behaviors\BaseControllerBehaviors;
use app\models\Ingredient;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\UploadedFile;
use app\models\UploadFile;
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
        $request = json_decode(Yii::$app->request->post('data'), true);
        $model = new UploadFile();
        $model->files = UploadedFile::getInstancesByName('files');
        return Product::createProduct($request, $model);
    }
    public function actionUpdate($id)
    {
        $request = json_decode(Yii::$app->request->post('data'), true);
        $model = new UploadFile();
        $model->files = UploadedFile::getInstancesByName('files');
        return Product::updateProduct($this->findModel($id), $request, $model);
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
