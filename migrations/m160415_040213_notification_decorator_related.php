<?php

use yii\db\Migration;

class m160415_040213_notification_decorator_related extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        //#------------------- notification_decorator -------------------#//
        $this->execute("
            CREATE TABLE IF NOT EXISTS `notification_decorator` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `slug` varchar(50) NOT NULL,
              `enabled` tinyint(4) NOT NULL DEFAULT '1',
              PRIMARY KEY (`id`),
              KEY `enabled` (`enabled`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;
        ");

        $this->execute("
            INSERT INTO `notification_decorator` (`id`, `slug`, `enabled`) VALUES
            (1, 'SITE', 1),
            (2, 'USER', 1),
            (3, 'ARTICLE', 1);
        ");

        //#------------------- notification_decorator_tag -------------------#//
        $this->execute("
            CREATE TABLE IF NOT EXISTS `notification_decorator_tag` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `decorator_id` int(11) NOT NULL,
              `tag` varchar(50) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `tag` (`tag`),
              KEY `decorator_id` (`decorator_id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

            ALTER TABLE `notification_decorator_tag`
              ADD CONSTRAINT `notification_decorator_tag_ibfk_1` FOREIGN KEY (`decorator_id`) REFERENCES `notification_decorator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
        ");
        $this->execute("
            INSERT INTO `notification_decorator_tag` (`id`, `decorator_id`, `tag`) VALUES
            (1, 1, 'siteName'),
            (2, 1, 'siteUrl'),
            (4, 2, 'userName'),
            (5, 2, 'userId'),
            (6, 3, 'articleName'),
            (7, 3, 'articleShortText'),
            (8, 3, 'articleUrl');
        ");

        //#------------------- notification_to_decorator -------------------#//
        $this->execute("
            CREATE TABLE IF NOT EXISTS `notification_to_decorator` (
              `notif_code` varchar(50) NOT NULL,
              `decorator_id` int(11) NOT NULL,
              UNIQUE KEY `notif_code` (`notif_code`,`decorator_id`),
              KEY `decorator_id` (`decorator_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

            ALTER TABLE `notification_to_decorator`
              ADD CONSTRAINT `notification_to_decorator_ibfk_1` FOREIGN KEY (`decorator_id`) REFERENCES `notification_decorator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
        ");
        $this->execute("
            INSERT INTO `notification_to_decorator` (`notif_code`, `decorator_id`) VALUES
            ('EVENT_ARTICLE_CREATED', 1),
            ('EVENT_USER_BLOCKED', 1),
            ('EVENT_USER_REGISTERED', 1),
            ('EVENT_ARTICLE_CREATED', 2),
            ('EVENT_USER_BLOCKED', 2),
            ('EVENT_USER_REGISTERED', 2),
            ('EVENT_ARTICLE_CREATED', 3);
        ");
    }

    public function safeDown()
    {
        $this->dropTable('notification_to_decorator');
        $this->dropTable('notification_decorator_tag');
        $this->dropTable('notification_decorator');
    }
}
