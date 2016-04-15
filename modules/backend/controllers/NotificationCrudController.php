<?php

namespace app\modules\backend\controllers;

use app\controllers\BackendController;
use app\modules\backend\models\NotifCrud\NotifCrudSave;
use app\modules\backend\models\NotifCrud\NotifCrudSearch;
use app\modules\backend\models\NotifCrud\NotifTagsRelated;
use Yii;

class NotificationCrudController extends BackendController
{

    public function actionIndex()
    {
        $searchModel = new NotifCrudSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->post());

        return $this->render('index_tpl', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        /** @var NotifCrudSave $model */
        $model = new NotifCrudSave();
        $isPostBack = $model->load(Yii::$app->request->post());
        if (!$isPostBack) {
            $model->enabled = 1;
        }

        if ($isPostBack && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create_tpl', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = NotifCrudSave::findOne($id);
        if (!is_null($model)) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    public function actionUpdate($id)
    {
        if (($model = NotifCrudSave::findOne($id)) === null) {
            return $this->redirect(['index']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create_tpl', [
                'model' => $model,
            ]);
        }
    }

    public function actionTagsRelated($eventCode)
    {
        $this->layout = false;
        $model = new NotifTagsRelated($eventCode);
        $tags = $model->getTagsRelated();

        return $this->render('tags_related_tpl', ['tags' => $tags]);
    }

}
