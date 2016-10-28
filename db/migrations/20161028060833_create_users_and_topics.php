<?php

use Phinx\Migration\AbstractMigration;

class CreateUsersAndTopics extends AbstractMigration
{
    public function up()
    {
      $this->execute('
CREATE TABLE `topics` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `question` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1');
      $this->execute('
ALTER TABLE `topics`
  ADD KEY `created_at` (`created_at`)');

      $this->execute('
CREATE TABLE `users` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `sub` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1');
      $this->execute('
ALTER TABLE `users`
  ADD UNIQUE KEY `sub` (`sub`);
');
    }
}
