<?php

namespace app\modules\backend\controllers;

use app\controllers\BackendController;
use app\modules\backend\models\UserCrud\UserSearch;

class UserCrudController extends BackendController
{

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->post());

        return $this->render('index_tpl', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
