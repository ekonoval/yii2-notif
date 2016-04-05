<?php

namespace app\modules\backend\controllers;

use yii\web\Controller;

/**
 * Default controller for the `Backend` module
 */
class UserCrudController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        echo "<h2>Vasya   </h2>\n";
//        return $this->render('index');
    }
}
