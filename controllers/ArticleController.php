<?php

namespace app\controllers;

use app\models\Article;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ArticleController extends Controller
{

    public function actionIndex()
    {
        pa('articles index'); exit;
    }

    public function actionView($id)
    {
        $article = Article::findOne($id);

        if (empty($article)) {
            throw new NotFoundHttpException("No article");
        }

        return $this->render('view_tpl', ['article' => $article]);
    }


}
