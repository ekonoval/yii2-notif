<?php

namespace app\modules\backend\controllers;

use app\controllers\BackendController;
use app\modules\backend\models\ArticleCrud\ArticleCrudSave;
use app\modules\backend\models\ArticleCrud\ArticleCrudSearch;
use Yii;

class ArticleCrudController extends BackendController
{

    public function actionIndex()
    {
        $searchModel = new ArticleCrudSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->post());

        return $this->render('index_tpl', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new ArticleCrudSave();
        $isPostBack = $model->load(Yii::$app->request->post());
        if ($isPostBack) {
            $model->author_id = Yii::$app->user->getId();
        } else {
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
        $model = ArticleCrudSave::findOne($id);
        if (!is_null($model)) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    public function actionUpdate($id)
    {
        if (($model = ArticleCrudSave::findOne($id)) === null) {
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

}
