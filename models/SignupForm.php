<?php

namespace app\models;

use app\ext\User\UserIdentity;
use Yii;
use yii\base\Model;

class SignupForm extends User
{
    public $password;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'trim'],
            [['username', 'password', 'email'], 'required'],
            [['username'], 'unique', ],
            ['email', 'email'],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $this->auth_key = Yii::$app->security->generateRandomString(32);
            $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            $this->status = self::STATUS_ACTIVE;

            if ($this->save()) {
                Yii::$app->user->login(UserIdentity::findIdentity($this->primaryKey));

                $auth = Yii::$app->authManager;
                $auth->assign($auth->getRole(UserIdentity::ROLE_USER), $this->primaryKey);
            }

            return true;
        }
        return false;
    }

}
