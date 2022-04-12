<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use app\behaviors\BaseControllerBehaviors;
use app\models\SubCategory;
use app\models\SubCategorySearch;
use yii\web\ForbiddenHttpException;
use Yii;

class SubCategoryController extends ActiveController
{
    public $modelClass = 'app\models\SubCategory';
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return BaseControllerBehaviors::getBaseBehaviors($behaviors, ['index']);
    }
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['delete']);
        return $actions;
    }
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->products) {
            throw new ForbiddenHttpException("Вы не можете удалить подкатегорию, если у подкатегории есть продукты.");
        }
        if ($model->delete()) {
            return ['message' => 'Вы удалили подкатегорию ' . $model->title, 'data' => null];
        }
        return ['message' => 'Ошибка удаления подкатегории ' . $model->title, 'data' => null];
    }
    public function actionIndex()
    {
        $searchModel = new SubCategorySearch();
        return $searchModel->search(Yii::$app->request->queryParams);
    }
    protected function findModel($id)
    {
        if (($model = SubCategory::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
