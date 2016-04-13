<?php
namespace app\widgets;

use app\ext\User\UserIdentity;
use Yii;
use yii\bootstrap\Nav;
use yii\helpers\Html;

class MenuWidget extends Nav
{
    public function init()
    {
        parent::init();

        if (Yii::$app->user->isGuest) {
            $this->items[] = ['label' => 'Signup', 'url' => ['/site/signup']];
            $this->items[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {

            if (Yii::$app->user->can(UserIdentity::ROLE_ADMIN)) {
                $this->items[] = ['label' => 'Articles', 'url' => ['/backend/article-crud/']];
                $this->items[] = ['label' => 'Users', 'url' => ['/backend/user-crud/']];
            }


            $this->items[] = ['label' => 'Cabinet', 'url' => ['/site/cabinet']];

            $this->items[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>';
        }
    }

}
