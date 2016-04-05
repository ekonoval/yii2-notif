<?php
namespace app\widgets;

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
