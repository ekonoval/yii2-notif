<?php

use yii\db\Migration;

class m160414_083007_browser_notif_dispatch extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `notification_browser_dispatch` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `notif_id` int(11) NOT NULL,
              `receiver_id` int(11) NOT NULL,
              `sender_id` int(11) NOT NULL,
              `status` tinyint(4) NOT NULL,
              `send_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `subject` varchar(255) NOT NULL,
              `body` text NOT NULL,
              PRIMARY KEY (`id`),
              KEY `receiver_id` (`receiver_id`),
              KEY `status` (`status`),
              KEY `send_at` (`send_at`),
              KEY `notif_id` (`notif_id`),
              KEY `sender_id` (`sender_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

            ALTER TABLE `notification_browser_dispatch`
              ADD CONSTRAINT `notification_browser_dispatch_ibfk_3` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
              ADD CONSTRAINT `notification_browser_dispatch_ibfk_1` FOREIGN KEY (`notif_id`) REFERENCES `notification` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
              ADD CONSTRAINT `notification_browser_dispatch_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
        ");
    }

    public function safeDown()
    {
        $this->dropTable('notification_browser_dispatch');
        return true;
    }
}
