<?php

use yii\db\Migration;

class m160413_091613_notification extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `notification` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `code` varchar(100) NOT NULL,
              `title` varchar(255) NOT NULL,
              `sender` int(11) NOT NULL,
              `receiver` int(11) NOT NULL,
              `enabled` tinyint(4) NOT NULL DEFAULT '1',
              `subject` varchar(255) NOT NULL,
              `body` text NOT NULL,
              PRIMARY KEY (`id`),
              KEY `enabled` (`enabled`),
              KEY `code` (`code`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
        ");

        $this->execute("
            INSERT INTO `notification` (`id`, `code`, `title`, `sender`, `receiver`, `enabled`, `subject`, `body`) VALUES
            (1, 'EVENT_USER_BLOCKED', 'Юзер заблокирован. Владельцу', 1, -2, 1, 'Блокировака пользователя ''{userName}'' на сайте {siteName}', 'Уважаемый, {userName},\r\n\r\nваш аккаунт был заблокирован на сайте {siteName}'),
            (2, 'EVENT_USER_BLOCKED', 'Юзер заблокирован. Админу', 1, 1, 1, 'Блокировака пользователя ''{userName}''. Админ-уведомление', 'Аккаунт {userName} [{userId}]\r\n\r\nбыл заблокирован на сайте {siteName}'),
            (3, 'EVENT_USER_REGISTERED', 'Успешная регистрация -> пользователю', 1, -2, 1, 'Успешная регистрация на сайте {siteName}', 'Вы успешно зарегистрировались на сайте {siteName} под логином ''{userName}''\r\n\r\n'),
            (4, 'EVENT_ARTICLE_CREATED', 'Добавление статьи', 1, -1, 1, 'Добавление статьи на сайте {siteName}', 'Уважаемый {userName}. На сайте {siteName} добавлена новая статья \"{articleName}\".\r\n\r\n{articleShortText}... \r\n\r\nЧитать далее: {articleUrl}\r\n');
        ");
    }

    public function safeDown()
    {
        $this->dropTable('notification');

        return true;
    }
}
