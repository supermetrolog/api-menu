<?php

namespace app\controllers;

use app\models\Login;
use app\models\User;
use yii\rest\ActiveController;
use Yii;
use app\exceptions\ValidationErrorHttpException;
use yii\web\UploadedFile;
use app\models\UploadFile;
use yii\web\NotFoundHttpException;
use app\behaviors\BaseControllerBehaviors;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return BaseControllerBehaviors::getBaseBehaviors($behaviors, ['login', 'index']);
    }

    public function actionLogin()
    {
        $model = new Login();
        if ($model->load(Yii::$app->request->post(), '')) {
            return $model->login();
        }
        throw new ValidationErrorHttpException($model->getErrorSummary(false));
    }

    public function actionLogout()
    {
        if (Yii::$app->user->isGuest) {
            return ['message' => 'Вы вышли из системы'];
        }
        $model = User::findIdentityByAccessToken(Yii::$app->user->identity->access_token);
        $model->generateAccessToken();
        return ['message' => 'Вы вышли из аккаунта', 'data' => $model->save(false)];
    }
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
