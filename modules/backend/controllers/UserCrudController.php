<?php

namespace app\modules\backend\controllers;

use app\controllers\BackendController;
use app\models\Notification;
use app\modules\backend\models\UserCrud\UserCrudSave;
use app\modules\backend\models\UserCrud\UserCrudSearch;
use Yii;
use yii\web\NotFoundHttpException;

class UserCrudController extends BackendController
{

    public function actionIndex()
    {
        $searchModel = new UserCrudSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->post());

        return $this->render('index_tpl', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
        if (($model = UserCrudSave::findOne($id)) === null) {
            return $this->redirect(['index']);
        }

//        $model->on(Notification::EVENT_USER_BLOCKED, function($event){
//            pa($event);exit;
//        }, ['custom' => 'data']);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update_tpl', [
                'model' => $model,
            ]);
        }
    }

}
