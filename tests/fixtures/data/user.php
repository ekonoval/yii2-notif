<?php

use app\models\User;

return [
    'admin' => [
        'id' => 1,
        'username' => 'admin',
        'email' => 'admin@mail.com',
        'status' => User::STATUS_ACTIVE,
        'created_at' => '',
        'auth_key' => Yii::$app->security->generateRandomString(),
        'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
        'password_reset_token' => null
    ],
    'admin1' => [
        'id' => 2,
        'username' => 'admin2',
        'email' => 'admin2@mail.com',
        'status' => User::STATUS_ACTIVE,
        'created_at' => '',
        'auth_key' => Yii::$app->security->generateRandomString(),
        'password_hash' => Yii::$app->security->generatePasswordHash('admin2'),
        'password_reset_token' => null
    ],

    'user' => [
        'id' => 3,
        'username' => 'user',
        'email' => 'user@mail.com',
        'status' => User::STATUS_ACTIVE,
        'created_at' => '',
        'auth_key' => Yii::$app->security->generateRandomString(),
        'password_hash' => Yii::$app->security->generatePasswordHash('user'),
        'password_reset_token' => null
    ],

    'user2' => [
        'id' => 4,
        'username' => 'user2',
        'email' => 'user2@mail.com',
        'status' => User::STATUS_ACTIVE,
        'created_at' => '',
        'auth_key' => Yii::$app->security->generateRandomString(),
        'password_hash' => Yii::$app->security->generatePasswordHash('user2'),
        'password_reset_token' => null
    ],
];