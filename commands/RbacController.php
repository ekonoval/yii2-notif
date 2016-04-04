<?php
namespace app\commands;

use app\ext\User\UserIdentity;
use Yii;
use yii\console\Controller;
use yii\rbac\DbManager;


class RbacController extends Controller
{

    public function actionInit()
    {
        /** @var DbManager $auth */
        $auth = Yii::$app->authManager;

        $auth->removeAll();

        // add "author" role and give this role the "createPost" permission
        $user = $auth->createRole(UserIdentity::ROLE_USER);
        $user->description = "Пользователь";
        $auth->add($user);

        //admin
        $admin = $auth->createRole(UserIdentity::ROLE_ADMIN);
        $admin->description = "Админ";
        $auth->add($admin);
        $auth->addChild($admin, $user);

        $auth->assign($admin, 1); //taken from migration init
    }
}
