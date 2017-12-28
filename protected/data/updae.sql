CREATE TABLE `user_game` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gameid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `gameid` (`gameid`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE `conf` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT, 
  `content` text NOT NULL DEFAULT '',
  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;