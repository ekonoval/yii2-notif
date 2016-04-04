<?php

use yii\db\Migration;

class m160404_075639_init extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `user` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
              `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
              `status` tinyint(4) NOT NULL,
              `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
              `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
              PRIMARY KEY (`id`),
              UNIQUE KEY `username` (`username`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
        ");

        $this->execute("
            INSERT INTO `user` (`id`, `username`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
            (1, 'admin', '$2y$13$.WoiAMgb8pp98ykLe.HvOeasEl3pPduevxpMIpENnuDrHBnrORl.e', NULL, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
        ");
    }

    public function safeDown()
    {
        //echo "m150403_131153_create_back_users_table cannot be reverted.\n";
        $this->dropTable('user');

        return true;
    }
}
