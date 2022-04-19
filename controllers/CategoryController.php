<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use app\behaviors\BaseControllerBehaviors;
use app\models\Category;
use app\models\CategorySearch;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;
use app\models\UploadFile;
use Yii;

class CategoryController extends ActiveController
{
    public $modelClass = 'app\models\Category';
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
        unset($actions['create']);
        unset($actions['update']);

        return $actions;
    }
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->subCategories) {
            throw new ForbiddenHttpException("Вы не можете удалить категорию, если у категории есть подкатегории.");
        }
        if ($model->delete()) {
            return ['message' => 'Вы удалили категорию ' . $model->title, 'data' => null];
        }
        return ['message' => 'Ошибка удаления категории ' . $model->title, 'data' => null];
    }
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        return $searchModel->search(Yii::$app->request->queryParams);
    }
    public function actionCreate()
    {
        $request = json_decode(Yii::$app->request->post('data'), true);
        $model = new UploadFile();
        $model->files = UploadedFile::getInstancesByName('files');
        return Category::createCategory($request, $model);
    }
    public function actionUpdate($id)
    {
        $request = json_decode(Yii::$app->request->post('data'), true);
        $model = new UploadFile();
        $model->files = UploadedFile::getInstancesByName('files');
        return Category::updateCategory($this->findModel($id), $request, $model);
    }
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
