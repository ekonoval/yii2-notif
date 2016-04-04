<?php

namespace app\models;

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

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function signup()
    {
        if ($this->validate()) {
            return true;
        }
        return false;
    }

}
