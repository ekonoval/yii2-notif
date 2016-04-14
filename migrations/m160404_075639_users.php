<?php

use app\models\User;
use yii\db\Migration;

class m160404_075639_users extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `user` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `status` tinyint(4) NOT NULL,
              `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
              `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
              `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `username` (`username`),
              KEY `status` (`status`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
        ");

        $this->batchInsert(
            'user',
            ['id', 'username', 'email', 'status', 'created_at', 'auth_key', 'password_hash', 'password_reset_token'],
            [
                [1, 'admin', 'admin@gmail.com', User::STATUS_ACTIVE, '',
                    Yii::$app->security->generateRandomString(), Yii::$app->security->generatePasswordHash('admin'), NULL],
                [2, 'admin2', 'admin2@gmail.com', User::STATUS_ACTIVE, '',
                    Yii::$app->security->generateRandomString(), Yii::$app->security->generatePasswordHash('admin2'), NULL],
                [3, 'user', 'user@gmail.com', User::STATUS_ACTIVE, '',
                    Yii::$app->security->generateRandomString(), Yii::$app->security->generatePasswordHash('user'), NULL],
                [4, 'user2', 'user2@gmail.com', User::STATUS_ACTIVE, '',
                    Yii::$app->security->generateRandomString(), Yii::$app->security->generatePasswordHash('user2'), NULL],
            ]
        );
    }

    public function safeDown()
    {
        //echo "m150403_131153_create_back_users_table cannot be reverted.\n";
        $this->dropTable('user');

        return true;
    }
}
