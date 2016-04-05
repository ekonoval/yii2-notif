<?php

use yii\db\Migration;

class m160405_120729_articles extends Migration
{
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `article` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `author_id` int(11) NOT NULL,
              `title` varchar(255) NOT NULL,
              `short_text` text NOT NULL,
              `full_text` text NOT NULL,
              `enabled` tinyint(4) NOT NULL DEFAULT '1',
              PRIMARY KEY (`id`),
              KEY `author_id` (`author_id`),
              KEY `enabled` (`enabled`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
        ");

        $this->execute("
            INSERT INTO `article` (`id`, `author_id`, `title`, `short_text`, `full_text`, `enabled`) VALUES
            (1, 1, 'fake1', 'Анонсируя концерт, к названию группы можно добавить любой эпитет и одним он покажется слишком сухим, другим - слишком общим, третьим - просто лишним. Это тот случай, когда достаточно только имени - Океан Ельзи.', '', 0);
        ");
    }

    public function safeDown()
    {
        $this->dropTable('article');

        return true;
    }
}
