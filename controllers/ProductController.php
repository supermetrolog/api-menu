<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use app\behaviors\BaseControllerBehaviors;
use app\models\Product;
use app\models\ProductSearch;
use Yii;

class ProductController extends ActiveController
{
    public $modelClass = 'app\models\Product';
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return BaseControllerBehaviors::getBaseBehaviors($behaviors, ['index']);
    }
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actions()
    {
        $actons = parent::actions();
        unset($actons['index']);
    }

    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        return $searchModel->search(Yii::$app->request->queryParams);
    }
}
