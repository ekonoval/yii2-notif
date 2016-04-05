<?php
namespace app\controllers;

use app\ext\User\UserIdentity;
use yii\filters\AccessControl;
use yii\web\Controller;

class BackendController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                //'only' => ['create', 'update'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => [UserIdentity::ROLE_ADMIN],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }
}
