<?php

namespace app\controllers;

use yii\web\Controller;

class ArticleController extends Controller
{

    public function actionIndex()
    {
        pa('articles index'); exit;
    }

    public function actionView($id)
    {
        pa($id); exit;
    }


}
